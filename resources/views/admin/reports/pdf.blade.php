<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan LukmanMart</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #334155;
            line-height: 1.4;
        }
        .header {
            margin-bottom: 20px;
            border-bottom: 2px solid #16a34a;
            padding-bottom: 15px;
        }
        .brand {
            font-size: 20px;
            font-weight: bold;
            color: #064e3b;
            text-transform: uppercase;
        }
        .title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 5px;
            color: #334155;
        }
        .meta {
            margin-top: 5px;
            font-size: 11px;
            color: #64748b;
        }
        .summary-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
        }
        .summary-title {
            font-size: 11px;
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .summary-grid {
            width: 100%;
        }
        .summary-col {
            width: 25%;
        }
        .summary-val {
            font-size: 14px;
            font-weight: bold;
            color: #1e293b;
        }
        .summary-val.emerald {
            color: #16a34a;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border-bottom: 1px solid #e2e8f0;
            padding: 8px 10px;
            text-align: left;
        }
        .table th {
            background-color: #f8fafc;
            font-size: 10px;
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
        }
        .table td {
            font-size: 11px;
        }
        .table td.right, .table th.right {
            text-align: right;
        }
        .table td.bold {
            font-weight: bold;
        }
        .table td.mono {
            font-family: monospace;
            font-size: 10px;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            color: #94a3b8;
            margin-top: 40px;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <span class="brand">LukmanMart</span>
        <div class="title">Laporan Rekapitulasi Transaksi Penjualan</div>
        <div class="meta">
            Periode Laporan: 
            <strong>
                {{ $startDate ? \Carbon\Carbon::parse($startDate)->format('d F Y') : 'Awal' }}
            </strong> 
            sampai 
            <strong>
                {{ $endDate ? \Carbon\Carbon::parse($endDate)->format('d F Y') : 'Akhir' }}
            </strong>
        </div>
    </div>

    <!-- Summary Box -->
    <div class="summary-box">
        <div class="summary-title">Ringkasan Laporan</div>
        <table class="summary-grid">
            <tr>
                <td class="summary-col">
                    <span style="font-size: 10px; color: #64748b;">Total Penjualan</span><br>
                    <span class="summary-val">{{ number_format($transactions->count(), 0, ',', '.') }} kali</span>
                </td>
                <td class="summary-col">
                    <span style="font-size: 10px; color: #64748b;">Total Potongan</span><br>
                    <span class="summary-val" style="color: #dc2626;">Rp{{ number_format($totalDiscount, 0, ',', '.') }}</span>
                </td>
                <td class="summary-col">
                    <span style="font-size: 10px; color: #64748b;">Total Pajak</span><br>
                    <span class="summary-val">Rp{{ number_format($totalTax, 0, ',', '.') }}</span>
                </td>
                <td class="summary-col">
                    <span style="font-size: 10px; color: #64748b;">Pendapatan Bersih</span><br>
                    <span class="summary-val emerald">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Detail table -->
    <table class="table">
        <thead>
            <tr>
                <th>Nomor Invoice</th>
                <th>Tanggal</th>
                <th>Kasir (Admin)</th>
                <th class="right">Subtotal</th>
                <th class="right">Diskon</th>
                <th class="right">Pajak</th>
                <th class="right">Grand Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $tx)
                <tr>
                    <td class="bold mono">{{ $tx->invoice_number }}</td>
                    <td>{{ $tx->transaction_date->format('d/m/Y') }}</td>
                    <td>{{ $tx->admin->name }}</td>
                    <td class="right">Rp{{ number_format($tx->subtotal, 0, ',', '.') }}</td>
                    <td class="right" style="color: #dc2626;">-Rp{{ number_format($tx->discount, 0, ',', '.') }}</td>
                    <td class="right">Rp{{ number_format($tx->tax, 0, ',', '.') }}</td>
                    <td class="right bold" style="color: #16a34a;">Rp{{ number_format($tx->grand_total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan Penjualan ini dicetak secara otomatis oleh sistem LukmanMart.</p>
        <p>Tanggal Cetak: {{ now()->isoFormat('D MMMM YYYY HH:mm') }}</p>
    </div>
</body>
</html>
