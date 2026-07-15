@extends('layouts.admin')

@section('title', 'Riwayat Transaksi')
@section('page-title', 'Riwayat Transaksi')

@section('breadcrumbs')
<nav class="flex text-sm text-slate-500 font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition">Dashboard</a>
    <span class="mx-2 text-slate-400">/</span>
    <span class="text-emerald-600">Transaksi</span>
</nav>
@endsection

@section('actions')
<a href="{{ route('admin.transactions.create') }}" class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl shadow-md hover:shadow-lg transition duration-200">
    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
    </svg>
    Kasir Baru
</a>
@endsection

@section('content')
<!-- Filter controls and tables -->
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    <!-- Header Controls -->
    <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <!-- Search and Date Filter Form -->
        <form method="GET" action="{{ route('admin.transactions.index') }}" class="flex flex-col sm:flex-row gap-3 flex-1">
            <!-- Search bar -->
            <div class="relative flex-1 max-w-md">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       class="pl-11 pr-4 block w-full rounded-xl border border-slate-200 bg-white py-2 text-sm text-slate-800 placeholder-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition duration-200" 
                       placeholder="Cari Nomor Invoice...">
            </div>

            <!-- Date filter -->
            <div class="w-full sm:w-48">
                <input type="date" 
                       name="date"
                       value="{{ request('date') }}"
                       onchange="this.form.submit()"
                       class="block w-full rounded-xl border border-slate-200 bg-white py-2 px-3.5 text-sm text-slate-700 placeholder-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition duration-200">
            </div>

            @if (request('search') || request('date'))
                <a href="{{ route('admin.transactions.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-slate-200 hover:bg-slate-50 text-slate-600 text-sm font-semibold rounded-xl transition duration-150">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        @if ($transactions->isEmpty())
            <div class="p-12 flex flex-col items-center justify-center text-slate-400">
                <svg class="w-16 h-16 mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <p class="text-base font-semibold">Transaksi tidak ditemukan</p>
                <p class="text-sm mt-1">Coba sesuaikan filter atau kata kunci pencarian Anda.</p>
            </div>
        @else
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider bg-slate-50/30">
                        <th class="py-4 px-6">Invoice</th>
                        <th class="py-4 px-6">Tanggal</th>
                        <th class="py-4 px-6">Petugas (Admin)</th>
                        <th class="py-4 px-6 text-right">Subtotal</th>
                        <th class="py-4 px-6 text-right">Diskon</th>
                        <th class="py-4 px-6 text-right">Pajak</th>
                        <th class="py-4 px-6 text-right">Grand Total</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @foreach ($transactions as $tx)
                        <tr class="hover:bg-slate-50/50 transition">
                            <!-- Invoice -->
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-800 font-mono">{{ $tx->invoice_number }}</span>
                            </td>

                            <!-- Date -->
                            <td class="py-4 px-6 text-slate-600 font-medium">
                                {{ $tx->transaction_date->format('d M Y') }}
                            </td>

                            <!-- Admin -->
                            <td class="py-4 px-6 text-slate-600 font-medium">
                                {{ $tx->admin->name }}
                            </td>

                            <!-- Subtotal -->
                            <td class="py-4 px-6 text-right text-slate-600 font-semibold">
                                Rp{{ number_format($tx->subtotal, 0, ',', '.') }}
                            </td>

                            <!-- Discount -->
                            <td class="py-4 px-6 text-right text-red-600 font-medium">
                                {{ $tx->discount > 0 ? '-Rp' . number_format($tx->discount, 0, ',', '.') : 'Rp0' }}
                            </td>

                            <!-- Tax -->
                            <td class="py-4 px-6 text-right text-slate-500 font-medium">
                                {{ $tx->tax > 0 ? 'Rp' . number_format($tx->tax, 0, ',', '.') : 'Rp0' }}
                            </td>

                            <!-- Grand Total -->
                            <td class="py-4 px-6 text-right text-emerald-600 font-bold">
                                Rp{{ number_format($tx->grand_total, 0, ',', '.') }}
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 text-right">
                                <a href="{{ route('admin.transactions.show', $tx) }}" class="inline-flex items-center p-2 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition" title="Lihat Invoice">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Invoice
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Pagination Footer -->
    @if ($transactions->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $transactions->links() }}
        </div>
    @endif
</div>
@endsection
