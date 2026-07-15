@extends('layouts.admin')

@section('title', 'Detail Transaksi - ' . $transaction->invoice_number)
@section('page-title', 'Detail Transaksi')

@section('styles')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printableInvoice, #printableInvoice * {
            visibility: visible;
        }
        #printableInvoice {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: 0;
            padding: 0;
            margin: 0;
            box-shadow: none;
        }
        .no-print {
            display: none !important;
        }
    }
</style>
@endsection

@section('breadcrumbs')
<nav class="flex text-sm text-slate-500 font-medium no-print">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition">Dashboard</a>
    <span class="mx-2 text-slate-400">/</span>
    <a href="{{ route('admin.transactions.index') }}" class="hover:text-emerald-600 transition">Transaksi</a>
    <span class="mx-2 text-slate-400">/</span>
    <span class="text-slate-800 font-semibold">{{ $transaction->invoice_number }}</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center space-x-2 no-print">
    <button onclick="window.print()" class="inline-flex items-center bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold px-4 py-2.5 rounded-xl transition duration-150 shadow-sm">
        <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
        </svg>
        Cetak Struk
    </button>
    <a href="{{ route('admin.transactions.index') }}" class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition duration-150 shadow-md hover:shadow-lg">
        <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        Daftar Transaksi
    </a>
</div>
@endsection

@section('content')
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-md p-8 max-w-3xl mx-auto" id="printableInvoice">
    <!-- Invoice Brand Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-slate-100 pb-6">
        <div>
            <div class="flex items-center space-x-2.5">
                <div class="p-1.5 bg-emerald-500 rounded-lg text-emerald-950 shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <span class="font-bold text-xl uppercase tracking-wider text-emerald-950">LukmanMart</span>
            </div>
            <p class="text-xs text-slate-400 font-semibold mt-1">Peralatan Rumah Tangga Pilihan Terbaik Anda</p>
        </div>
        <div class="text-left md:text-right mt-4 md:mt-0">
            <h4 class="text-sm font-bold text-slate-400 uppercase tracking-widest leading-none">Nomor Invoice</h4>
            <h2 class="text-xl font-bold font-mono text-slate-800 tracking-wide mt-1">{{ $transaction->invoice_number }}</h2>
        </div>
    </div>

    <!-- Meta Details Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 py-6 border-b border-slate-100 text-sm">
        <div>
            <span class="text-xs text-slate-400 font-semibold uppercase block">Tanggal Transaksi</span>
            <span class="text-slate-700 font-bold block mt-1">{{ $transaction->transaction_date->format('d MMMM YYYY') }}</span>
        </div>
        <div>
            <span class="text-xs text-slate-400 font-semibold uppercase block">Petugas Kasir</span>
            <span class="text-slate-700 font-bold block mt-1">{{ $transaction->admin->name }}</span>
        </div>
        <div>
            <span class="text-xs text-slate-400 font-semibold uppercase block">Status Pembayaran</span>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 mt-1">
                Lunas
            </span>
        </div>
    </div>

    <!-- Items table -->
    <div class="py-6">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="border-b border-slate-200 text-xs font-bold text-slate-400 uppercase tracking-wider">
                    <th class="pb-3 pl-2">Nama Barang</th>
                    <th class="pb-3 text-right">Harga Satuan</th>
                    <th class="pb-3 text-center">Jumlah</th>
                    <th class="pb-3 text-right pr-2">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($transaction->details as $item)
                    <tr>
                        <td class="py-4 pl-2 font-semibold text-slate-800">{{ $item->product_name }}</td>
                        <td class="py-4 text-right text-slate-600 font-medium">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="py-4 text-center text-slate-700 font-semibold">{{ $item->quantity }}</td>
                        <td class="py-4 text-right text-slate-800 font-bold pr-2">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Receipt summary and breakdown -->
    <div class="border-t border-slate-200 pt-6 flex flex-col md:flex-row justify-between gap-6">
        <!-- Notes area -->
        <div class="flex-1 max-w-md bg-slate-50 p-4 rounded-xl border border-slate-100 text-xs text-slate-500">
            <span class="font-bold text-slate-400 uppercase block mb-1">Catatan</span>
            <p class="leading-relaxed whitespace-pre-line">{{ $transaction->notes ?? 'Tidak ada catatan transaksi.' }}</p>
        </div>

        <!-- Math Breakdown -->
        <div class="w-full md:w-64 space-y-2.5 text-sm">
            <div class="flex items-center justify-between text-slate-500 font-medium">
                <span>Subtotal</span>
                <span>Rp{{ number_format($transaction->subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="flex items-center justify-between text-slate-500 font-medium">
                <span>Diskon</span>
                <span class="text-red-600">-Rp{{ number_format($transaction->discount, 0, ',', '.') }}</span>
            </div>
            <div class="flex items-center justify-between text-slate-500 font-medium">
                <span>Pajak</span>
                <span>Rp{{ number_format($transaction->tax, 0, ',', '.') }}</span>
            </div>
            <div class="border-t border-slate-200 my-2"></div>
            <div class="flex items-center justify-between">
                <span class="text-base font-bold text-slate-700">Grand Total</span>
                <span class="text-xl font-bold text-emerald-600">Rp{{ number_format($transaction->grand_total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Bottom Thank You -->
    <div class="text-center pt-8 border-t border-slate-100 mt-8 text-slate-400 text-xs">
        <p class="font-medium">Terima kasih atas kunjungan Anda!</p>
        <p class="mt-0.5">LukmanMart - Belanja Hemat, Rumah Tangga Sehat</p>
    </div>
</div>
@endsection
