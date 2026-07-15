<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\SalesReportExport;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Default range: current month
        $startDate = $request->get('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->endOfDay()->format('Y-m-d'));

        $query = Transaction::with('admin')
            ->whereDate('transaction_date', '>=', $startDate)
            ->whereDate('transaction_date', '<=', $endDate);

        $transactions = $query->orderBy('transaction_date', 'asc')->get();

        // Calculate summary cards
        $totalSales = $transactions->count();
        $totalRevenue = $transactions->sum('grand_total');
        $totalDiscount = $transactions->sum('discount');
        $totalTax = $transactions->sum('tax');

        return view('admin.reports.index', compact(
            'transactions',
            'startDate',
            'endDate',
            'totalSales',
            'totalRevenue',
            'totalDiscount',
            'totalTax'
        ));
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $query = Transaction::with('admin');

        if ($startDate) {
            $query->whereDate('transaction_date', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('transaction_date', '<=', $endDate);
        }

        $transactions = $query->orderBy('transaction_date', 'asc')->get();
        
        $totalRevenue = $transactions->sum('grand_total');
        $totalDiscount = $transactions->sum('discount');
        $totalTax = $transactions->sum('tax');

        $pdf = Pdf::loadView('admin.reports.pdf', compact('transactions', 'startDate', 'endDate', 'totalRevenue', 'totalDiscount', 'totalTax'));
        
        $filename = 'laporan-penjualan-' . ($startDate ?? 'semua') . '-ke-' . ($endDate ?? 'semua') . '.pdf';
        return $pdf->download($filename);
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $filename = 'laporan-penjualan-' . ($startDate ?? 'semua') . '-ke-' . ($endDate ?? 'semua') . '.xlsx';
        return Excel::download(new SalesReportExport($startDate, $endDate), $filename);
    }
}
