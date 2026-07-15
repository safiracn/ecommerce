@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-emerald-700 to-emerald-950">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="hero-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                        <circle cx="20" cy="20" r="2" fill="white"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#hero-pattern)"/>
            </svg>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <span class="inline-flex items-center bg-emerald-500/30 text-emerald-100 text-xs font-bold px-3.5 py-1.5 rounded-full border border-emerald-400/30">
                        <svg class="w-3.5 h-3.5 mr-1.5 text-emerald-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/>
                        </svg>
                        Solusi Peralatan Rumah Tangga Anda
                    </span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight">
                        Hunian Nyaman dengan
                        <span class="text-emerald-300 block">Peralatan Terbaik</span>
                    </h1>
                    <p class="text-base md:text-lg text-emerald-100/90 max-w-lg leading-relaxed">
                        Dapatkan produk kebersihan, alat dapur, wadah penyimpanan, dan gantungan minimalis terlengkap dengan harga terjangkau & kualitas terjamin.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('public.products') }}" class="inline-flex items-center justify-center bg-white text-emerald-700 font-bold px-8 py-3.5 rounded-2xl shadow-lg hover:shadow-xl hover:bg-emerald-50 transition duration-300">
                            Belanja Sekarang
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Hero Banner Promo Card --}}
                <div class="flex justify-center">
                    <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20 shadow-2xl text-white max-w-sm w-full text-center space-y-6">
                        <span class="bg-amber-400 text-slate-900 font-extrabold text-xs px-3.5 py-1 rounded-full uppercase tracking-wider shadow">PROMO BULAN INI</span>
                        <div>
                            <h3 class="text-3xl font-extrabold">Diskon Belanja</h3>
                            <p class="text-emerald-200 font-semibold text-lg mt-1">Hingga Rp 15.000</p>
                        </div>
                        <p class="text-xs text-emerald-100/80">Otomatis terpotong saat checkout dengan minimal transaksi belanja Rp 150.000 di seluruh kategori produk.</p>
                        <div class="border-t border-white/10 pt-4 flex justify-between text-xs text-emerald-100">
                            <span>*Syarat & Ketentuan berlaku</span>
                            <span>Gratis Ongkir</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Kategori Populer --}}
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 tracking-tight">Kategori Populer</h2>
                <p class="mt-2 text-sm text-slate-500">Temukan barang kebutuhan rumah tangga per kategori pilihan</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('public.products', ['category' => $category->slug]) }}" class="group">
                        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md hover:border-emerald-300 hover:-translate-y-1 transition duration-300 flex items-center gap-4">
                            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-100 transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 text-sm group-hover:text-emerald-600 transition">{{ $category->name }}</h3>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $category->products_count }} Produk</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Promo Section --}}
    <section class="py-6 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-3xl p-8 md:p-12 text-white flex flex-col md:flex-row items-center justify-between gap-8 shadow-xl">
                <div class="space-y-4 text-center md:text-left">
                    <span class="bg-emerald-700/50 text-emerald-100 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-emerald-400/20">Spesial Rumah Bersih</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold leading-tight">Paket Kebersihan & Organizer Hemat</h2>
                    <p class="text-emerald-100 max-w-lg text-sm md:text-base">Mulai dengan melengkapi ember pel, sapu minimalis, wadah container lipat, dan sikat toilet modern di LukmanMart.</p>
                </div>
                <a href="{{ route('public.products') }}" class="bg-white text-emerald-700 font-bold py-3 px-8 rounded-2xl hover:bg-emerald-50 transition shadow-lg flex-shrink-0">
                    Jelajahi Produk
                </a>
            </div>
        </div>
    </section>

    {{-- Produk Terbaru --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-8">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-800 tracking-tight">Produk Terbaru</h2>
                    <p class="mt-2 text-sm text-slate-500">Peralatan rumah tangga keluaran terbaru kami</p>
                </div>
                <a href="{{ route('public.products') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold text-sm transition">Lihat Semua &rarr;</a>
            </div>

            @if($featuredProducts->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($featuredProducts as $product)
                        <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition duration-300 overflow-hidden flex flex-col justify-between">
                            <div>
                                <div class="relative aspect-square bg-slate-100 overflow-hidden">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    <span class="absolute top-2.5 left-2.5 bg-white/90 backdrop-blur-sm text-slate-600 text-[10px] font-bold px-2 py-0.5 rounded-lg shadow-sm">{{ $product->category->name }}</span>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold text-slate-800 text-sm group-hover:text-emerald-600 transition line-clamp-2 mb-1">{{ $product->name }}</h3>
                                    <p class="text-emerald-600 font-extrabold text-sm md:text-base">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="p-4 pt-0">
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 rounded-xl text-xs transition">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        + Keranjang
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Produk Terlaris --}}
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-8">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-800 tracking-tight">Paling Laris</h2>
                    <p class="mt-2 text-sm text-slate-500">Produk terfavorit yang paling sering dibeli</p>
                </div>
                <a href="{{ route('public.products') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold text-sm transition">Lihat Semua &rarr;</a>
            </div>

            @if($bestSellers->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($bestSellers as $product)
                        <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition duration-300 overflow-hidden flex flex-col justify-between">
                            <div>
                                <div class="relative aspect-square bg-slate-100 overflow-hidden">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    <span class="absolute top-2.5 left-2.5 bg-white/90 backdrop-blur-sm text-slate-600 text-[10px] font-bold px-2 py-0.5 rounded-lg shadow-sm">{{ $product->category->name }}</span>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold text-slate-800 text-sm group-hover:text-emerald-600 transition line-clamp-2 mb-1">{{ $product->name }}</h3>
                                    <p class="text-emerald-600 font-extrabold text-sm md:text-base">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="p-4 pt-0">
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 rounded-xl text-xs transition">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        + Keranjang
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Keunggulan Toko --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center p-6 bg-slate-50 rounded-2xl">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm mb-1">Kualitas Premium</h3>
                    <p class="text-xs text-slate-400">Semua produk lolos quality control ketat.</p>
                </div>
                <div class="text-center p-6 bg-slate-50 rounded-2xl">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm mb-1">Harga Terbaik</h3>
                    <p class="text-xs text-slate-400">Harga bersaing dengan penawaran promo menarik.</p>
                </div>
                <div class="text-center p-6 bg-slate-50 rounded-2xl">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm mb-1">Pengiriman Cepat</h3>
                    <p class="text-xs text-slate-400">Proses pengiriman yang aman & terpercaya.</p>
                </div>
                <div class="text-center p-6 bg-slate-50 rounded-2xl">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm mb-1">Dukungan Layanan</h3>
                    <p class="text-xs text-slate-400">Tim kami siap melayani seluruh pertanyaan Anda.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
