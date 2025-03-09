<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class WorkOrderReportController extends Controller
{
    public function excel(Request $request)
    {
        $query = WorkOrder::query();

        // Filter berdasarkan step
        if ($request->filled('step')) {
            $query->where('step', $request->step);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan operator
        if ($request->filled('operator_id')) {
            $query->where('operator_id', $request->operator_id);
        }

        // Filter berdasarkan range tanggal
        if ($request->filled('date_range')) {
            [$startDate, $endDate] = explode(' - ', $request->date_range);
            $query->whereBetween('created_at', [
                Carbon::createFromFormat('d/m/Y', trim($startDate))->startOfDay(),
                Carbon::createFromFormat('d/m/Y', trim($endDate))->startOfDay(),
            ]);
        }

        $workOrders = $query->get();
        // Membuat Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'Work Order Number');
        $sheet->setCellValue('B1', 'Product Name');
        $sheet->setCellValue('C1', 'Quantity');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Operator ID');
        $sheet->setCellValue('F1', 'Created At');

        // Data
        $row = 2;
        foreach ($workOrders as $order) {
            $sheet->setCellValue('A' . $row, $order->work_order_number);
            $sheet->setCellValue('B' . $row, $order->product_name);
            $sheet->setCellValue('C' . $row, $order->quantity);
            $sheet->setCellValue('D' . $row, $order->status);
            $sheet->setCellValue('E' . $row, $order->operator_id ?? '-');
            $sheet->setCellValue('F' . $row, $order->created_at->format('Y-m-d'));
            $row++;
        }

        // Penyesuaian Nama File Berdasarkan Filter
        $fileNameParts = ['work_orders'];
        if ($request->filled('step')) {
            $fileNameParts[] = 'step_' . $request->step;
        }
        if ($request->filled('status')) {
            $fileNameParts[] = 'status_' . $request->status;
        }
        if ($request->filled('operator_id')) {
            $fileNameParts[] = 'operator_' . $request->operator_id;
        }
        if ($request->filled('date_range')) {
            $dateRange = str_replace('/', '-', $request->date_range);
            $fileNameParts[] = str_replace(' ', '', str_replace(' - ', '_to_', $dateRange));
        }

        $fileName = implode('_', $fileNameParts) . '.xlsx';

        // Output Excel
        $writer = new Xlsx($spreadsheet);

        // Kirim response sebagai file unduhan
        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $fileName);
    }

}
