<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use App\Models\WorkOrderProgressMaster;
use Illuminate\Http\Request;

class WorkOrderProgressMasterController extends Controller
{
    /**
     * Display a listing of the progress master.
     */
    public function index()
    {
        $progressMasters = WorkOrderProgressMaster::all();
        return view('project.progress_master.index', compact('progressMasters'));
    }

    /**
     * Show the form for creating a new progress master.
     */
    public function create()
    {
        $workOrders = WorkOrder::all();
        return view('project.progress_master.create', compact('workOrders'));
    }

    /**
     * Store a newly created progress master in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        WorkOrderProgressMaster::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('workorderprogressmaster.index')
            ->with('success', 'Progress Master created successfully.');
    }

    /**
     * Show the form for editing the specified progress master.
     */
    public function edit(WorkOrderProgressMaster $progressMaster)
    {
        $workOrders = WorkOrder::all();
        return view('project.progress_master.edit', compact('progressMaster', 'workOrders'));
    }

    /**
     * Update the specified progress master in storage.
     */
    public function update(Request $request, WorkOrderProgressMaster $progressMaster)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $progressMaster->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('workorderprogressmaster.index')
            ->with('success', 'Progress Master updated successfully.');
    }

    /**
     * Remove the specified progress master from storage.
     */
    public function destroy(WorkOrderProgressMaster $progressMaster)
    {
        $progressMaster->delete();

        return redirect()->route('workorderprogressmaster.index')->with('success', 'Progress master deleted successfully.');
    }
}
