@extends('layouts.public')

@section('title', 'Riwayat Pesanan')

@section('content')
<section class="py-12 bg-slate-50 min-h-[calc(100vh-16rem)]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-slate-800 tracking-tight mb-8">Riwayat Pesanan</h1>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center">
                <svg class="w-5 h-5 mr-3 flex-shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            {{-- Navigation / User Card --}}
            <div class="md:col-span-1 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center text-center space-y-4">
                <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" class="w-24 h-24 rounded-full object-cover border-2 border-emerald-500 shadow-sm">
                
                <div>
                    <h2 class="font-bold text-slate-800 text-lg">{{ Auth::user()->name }}</h2>
                    <p class="text-slate-400 text-xs">{{ Auth::user()->email }}</p>
                </div>

                <div class="w-full border-t border-slate-100 pt-4 flex flex-col gap-2">
                    <a href="{{ route('customer.profile') }}" class="w-full inline-flex justify-center bg-slate-50 hover:bg-slate-100 text-slate-600 font-bold px-4 py-2.5 rounded-xl text-xs transition">
                        Edit Profil
                    </a>
                    <a href="{{ route('customer.orders') }}" class="w-full inline-flex justify-center bg-emerald-50 text-emerald-700 font-bold px-4 py-2.5 rounded-xl text-xs transition">
                        Riwayat Pesanan
                    </a>
                </div>
            </div>

            {{-- Orders List --}}
            <div class="md:col-span-2 space-y-6">
                @if($orders->count() > 0)
                    @foreach($orders as $order)
                        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                            {{-- Header --}}
                            <div class="bg-slate-50 px-5 py-4 border-b border-slate-100 flex flex-wrap justify-between items-center gap-3">
                                <div>
                                    <p class="text-xs text-slate-400 font-semibold mb-0.5">NOMOR INVOICE</p>
                                    <span class="font-bold text-sm text-slate-700">{{ $order->invoice_number }}</span>
                                </div>
                                <div class="text-left md:text-right">
                                    <p class="text-xs text-slate-400 font-semibold mb-0.5">TANGGAL TRANSAKSI</p>
                                    <span class="text-sm font-semibold text-slate-600">{{ $order->transaction_date->format('d M Y') }}</span>
                                </div>
                            </div>

                            {{-- Body (Items) --}}
                            <div class="p-5 divide-y divide-slate-100">
                                @foreach($order->details as $detail)
                                    <div class="py-3 first:pt-0 last:pb-0 flex items-center justify-between gap-4">
                                        <div class="min-w-0">
                                            <p class="font-bold text-slate-800 text-sm truncate">{{ $detail->product_name }}</p>
                                            <span class="text-xs text-slate-400">{{ $detail->quantity }} x Rp {{ number_format($detail->price, 0, ',', '.') }}</span>
                                        </div>
                                        <span class="text-sm font-bold text-slate-700">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Footer (Summary) --}}
                            <div class="bg-slate-50/50 px-5 py-4 border-t border-slate-100 flex justify-between items-center">
                                <div>
                                    <span class="inline-flex items-center bg-emerald-100 text-emerald-700 text-xs font-bold px-2.5 py-1 rounded-lg">
                                        Selesai
                                    </span>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs text-slate-400 font-semibold block mb-0.5">TOTAL PEMBAYARAN</span>
                                    <span class="text-emerald-600 font-bold text-base">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Pagination --}}
                    <div>
                        {{ $orders->links() }}
                    </div>
                @else
                    {{-- Empty Orders --}}
                    <div class="text-center py-16 bg-white rounded-2xl border border-slate-100 shadow-sm">
                        <div class="w-20 h-20 mx-auto bg-slate-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-slate-700 text-base mb-1">Belum Ada Transaksi</h3>
                        <p class="text-slate-400 text-xs max-w-xs mx-auto mb-4">Anda belum memiliki riwayat transaksi pembelian apapun.</p>
                        <a href="{{ route('public.products') }}" class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold px-4 py-2 rounded-xl transition">
                            Mulai Belanja
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
