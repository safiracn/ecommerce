@extends('layouts.admin')

@section('title', 'Laporan Penjualan')
@section('page-title', 'Laporan Penjualan')

@section('breadcrumbs')
<nav class="flex text-sm text-slate-500 font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition">Dashboard</a>
    <span class="mx-2 text-slate-400">/</span>
    <span class="text-emerald-600">Laporan</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center space-x-2">
    <!-- Export PDF -->
    <a href="{{ route('admin.reports.export-pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}" 
       class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl shadow-md transition duration-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        Ekspor PDF
    </a>
    
    <!-- Export Excel -->
    <a href="{{ route('admin.reports.export-excel', ['start_date' => $startDate, 'end_date' => $endDate]) }}" 
       class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl shadow-md transition duration-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        Ekspor Excel
    </a>
</div>
@endsection

@section('content')
<!-- Filter controls card -->
<div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm mb-8">
    <h3 class="font-bold text-slate-800 mb-4 flex items-center">
        <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
        </svg>
        Filter Rentang Tanggal
    </h3>
    
    <form method="GET" action="{{ route('admin.reports.index') }}" class="flex flex-col md:flex-row items-end gap-4">
        <!-- Start Date -->
        <div class="flex-1 w-full">
            <label for="start_date" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Tanggal Mulai</label>
            <input type="date" 
                   name="start_date" 
                   id="start_date" 
                   value="{{ $startDate }}"
                   required
                   class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 py-2.5 px-3.5 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition duration-200">
        </div>

        <!-- End Date -->
        <div class="flex-1 w-full">
            <label for="end_date" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Tanggal Selesai</label>
            <input type="date" 
                   name="end_date" 
                   id="end_date" 
                   value="{{ $endDate }}"
                   required
                   class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 py-2.5 px-3.5 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition duration-200">
        </div>

        <!-- Apply Button -->
        <button type="submit" class="w-full md:w-32 bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold py-2.5 rounded-xl shadow-md transition duration-150">
            Terapkan
        </button>
    </form>
</div>

<!-- Summaries Cards Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Transaksi -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Transaksi Terjadi</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ number_format($totalSales, 0, ',', '.') }} kali</h3>
        </div>
        <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
        </div>
    </div>

    <!-- Total Diskon -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Potongan Diskon</p>
            <h3 class="text-2xl font-bold text-red-600">Rp{{ number_format($totalDiscount, 0, ',', '.') }}</h3>
        </div>
        <div class="p-3 bg-red-50 rounded-xl text-red-600">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5a2 2 0 10-2 2h2zm0 0h4" />
            </svg>
        </div>
    </div>

    <!-- Total Pajak -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total Pajak</p>
            <h3 class="text-2xl font-bold text-slate-700">Rp{{ number_format($totalTax, 0, ',', '.') }}</h3>
        </div>
        <div class="p-3 bg-slate-50 rounded-xl text-slate-500">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
            </svg>
        </div>
    </div>

    <!-- Total Pendapatan Bersih -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Pendapatan Bersih</p>
            <h3 class="text-2xl font-bold text-emerald-600">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</h3>
        </div>
        <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>
</div>

<!-- Laporan Table -->
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    <div class="p-5 border-b border-slate-100 bg-slate-50/50">
        <h4 class="font-bold text-slate-800">Detail Transaksi Penjualan</h4>
    </div>
    
    <div class="overflow-x-auto">
        @if ($transactions->isEmpty())
            <div class="p-12 flex flex-col items-center justify-center text-slate-400">
                <svg class="w-16 h-16 mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <p class="text-base font-semibold">Tidak ada data transaksi</p>
                <p class="text-sm mt-1">Belum ada transaksi tercatat dalam rentang tanggal ini.</p>
            </div>
        @else
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider bg-slate-50/30">
                        <th class="py-4 px-6">Invoice</th>
                        <th class="py-4 px-6">Tanggal</th>
                        <th class="py-4 px-6">Kasir (Admin)</th>
                        <th class="py-4 px-6 text-right">Subtotal</th>
                        <th class="py-4 px-6 text-right">Diskon</th>
                        <th class="py-4 px-6 text-right">Pajak</th>
                        <th class="py-4 px-6 text-right">Grand Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($transactions as $tx)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="py-4 px-6 font-bold font-mono text-slate-800">{{ $tx->invoice_number }}</td>
                            <td class="py-4 px-6 text-slate-600 font-medium">{{ $tx->transaction_date->format('d/m/Y') }}</td>
                            <td class="py-4 px-6 text-slate-600 font-medium">{{ $tx->admin->name }}</td>
                            <td class="py-4 px-6 text-right text-slate-600 font-semibold">Rp{{ number_format($tx->subtotal, 0, ',', '.') }}</td>
                            <td class="py-4 px-6 text-right text-red-600 font-semibold">-Rp{{ number_format($tx->discount, 0, ',', '.') }}</td>
                            <td class="py-4 px-6 text-right text-slate-600 font-medium">Rp{{ number_format($tx->tax, 0, ',', '.') }}</td>
                            <td class="py-4 px-6 text-right text-emerald-600 font-bold">Rp{{ number_format($tx->grand_total, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
