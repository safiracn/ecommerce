<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SalesReportExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = Transaction::with('admin');

        if ($this->startDate) {
            $query->whereDate('transaction_date', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('transaction_date', '<=', $this->endDate);
        }

        return $query->orderBy('transaction_date', 'asc')->get();
    }

    public function headings(): array
    {
        return [
            'Nomor Invoice',
            'Tanggal Transaksi',
            'Kasir (Admin)',
            'Subtotal (Rp)',
            'Diskon (Rp)',
            'Pajak (Rp)',
            'Grand Total (Rp)',
            'Catatan'
        ];
    }

    public function map($row): array
    {
        return [
            $row->invoice_number,
            $row->transaction_date->format('Y-m-d'),
            $row->admin->name,
            $row->subtotal,
            $row->discount,
            $row->tax,
            $row->grand_total,
            $row->notes ?? '-'
        ];
    }
}
