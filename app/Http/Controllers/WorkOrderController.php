<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WorkOrder;
use App\Models\WorkOrderProgress;
use App\Models\WorkOrderProgressMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkOrderController extends Controller
{
    public function index(Request $request)
    {
        $operators = User::where('role_id', '3')->get();
        $pms = WorkOrderProgressMaster::query();
        $progressMasters = $pms->orderBy('step')->get();
        $qwo = WorkOrder::query();


        $filters = collect([
            'step' => $request->filled('step')
                ? optional($pms->where('step', $request->step)->first())->description
                : null,
            'status' => $request->status,
            'operator' => $request->filled('operator') ?
                optional($operators->where('id', $request->operator_id)->first())->name
                : null,
            'date_range' => $request->date_range,
        ])->filter()->all();


        // Filter Date Range
        if ($request->filled('date_range')) {
            [$startDate, $endDate] = explode(' - ', $request->date_range);
            $qwo->whereBetween('created_at', [
                Carbon::createFromFormat('d/m/Y', trim($startDate))->startOfDay(),
                Carbon::createFromFormat('d/m/Y', trim($endDate))->startOfDay(),
            ]);
        }

        if ($request->step) {
            $qwo = $qwo->where('status', $request->step);
        }
        if ($request->operator_id) {
            $qwo = $qwo->where('operator_id', $request->operator_id);
        }
        if (auth()->user()->role_id == 3) {
            $qwo = $qwo->where('operator_id', auth()->user()->id);
        }
        $workorders = $qwo->get();

        $stepCounts = [
            '1' => $workorders->where('status', 1)->count(),
            '2-99' => $workorders->whereBetween('status', [2, 99])->count(),
            '100' => $workorders->where('status', 100)->count(),
            '101' => $workorders->where('status', 101)->count(),
        ];

        $groupedSteps = [
            '1' => $progressMasters->where('step', 1)->first(),
            '2-99' => $progressMasters->whereBetween('step', [2, 99]),
            '100' => $progressMasters->where('step', 100)->first(),
            '101' => $progressMasters->where('step', 101)->first(),
        ];

        return view('project.work_order.index', compact('workorders', 'groupedSteps', 'operators', 'stepCounts', 'progressMasters', 'filters'));
    }

    public function create()
    {
        $operators = User::where('role_id', '3')->get();
        return view('project.work_order.create', compact('operators'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'due_date' => 'nullable|date',
            'operator_id' => 'nullable|exists:users,id'
        ]);

        $workOrder = WorkOrder::create($request->all());

        // Create initial progress entry
        WorkOrderProgress::create([
            'work_order_id' => $workOrder->id,
            'step' => 1,
            'note' => 'Work Order created.',
            'started_at' => now(),
            'ended_at' => null,
        ]);

        return redirect()->route('workorder.index')->with('success', 'Work Order created successfully.');
    }

    public function show(WorkOrder $workorder)
    {
        $operator = User::find($workorder->operator_id);
        $progressMasters = WorkOrderProgressMaster::all();
        $progresses = WorkOrderProgress::where('work_order_id', $workorder->id)->get();
        return view('project.work_order.show', compact('operator', 'workorder', 'progresses', 'progressMasters'));
    }

    public function edit(WorkOrder $workorder)
    {
        $operators = User::where('role_id', '3')->get();
        $progressMasters = WorkOrderProgressMaster::orderBy('step')->get();
        return view('project.work_order.edit', compact('workorder', 'operators', 'progressMasters'));
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'product_name' => 'required|string|max:255',
                'quantity' => 'required|integer',
                'deadline' => 'nullable',
                'status' => 'required|integer',
                'operator_id' => 'nullable|exists:users,id'
            ]);
            $workOrder = WorkOrder::firstWhere('work_order_number', $request->work_order_number);

            $validated = $workOrder->update([
                'product_name' => $request->product_name,
                'quantity' => $request->quantity,
                'deadline' => $request->deadline,
                'status' => $request->status,
                'operator_id' => $request->operator_id,
            ]);

            // Create progress entry for updates
            WorkOrderProgress::create([
                'work_order_id' => WorkOrder::where('work_order_number', $request->work_order_number)->firstOrFail()->id,
                'step' => $request->status, // Assuming 2 indicates an update in progress
                'note' => 'Work Order updated.',
                'started_at' => now(),
                'ended_at' => null,
            ]);
            return redirect()->route('workorder.index')
                ->with('success', 'Work Order updated successfully.');
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    public function nextStep(Request $request)
    {
        try {
            $request->validate([
                'work_order_number' => 'required|string|exists:work_orders,work_order_number',
            ]);

            $workOrder = WorkOrder::firstWhere('work_order_number', $request->work_order_number);

            // Cek apakah pengguna adalah operator
            if (auth()->user()->role->name !== 'Operator') {
                return redirect()->route('workorder.index')
                    ->with('error', 'Unauthorized action.');
            }

            // Ambil daftar langkah yang valid dari WorkOrderProgressMaster
            $validSteps = WorkOrderProgressMaster::pluck('step')->sort()->values();

            // Cari langkah berikutnya yang lebih besar dari status saat ini
            $nextStep = $validSteps->first(function ($step) use ($workOrder) {
                return $step > $workOrder->status && $step < 101; // Lewati step 101
            });

            // Jika tidak ada langkah berikutnya yang valid
            if (!$nextStep) {
                return redirect()->route('workorder.index')
                    ->with('error', 'No valid next step available.');
            }

            // Update status ke langkah berikutnya
            $workOrder->status = $nextStep;
            $workOrder->save();
            // Buat catatan progress
            WorkOrderProgress::create([
                'work_order_id' => $workOrder->id,
                'step' => $nextStep,
                'note' => 'Step advanced by ' . auth()->user()->name,
                'started_at' => now(),
                'ended_at' => null,
            ]);

            return redirect()->route('workorder.index')
                ->with('success', 'Step advanced successfully.');
        } catch (\Exception $th) {
            return redirect()->route('workorder.index')
                ->with('error', 'Failed to advance step: ' . $th->getMessage());
        }
    }


    public function destroy(WorkOrder $workorder)
    {
        $workorder->delete();

        return redirect()->route('workorder.index')->with('success', 'Work Order deleted successfully.');
    }
}
