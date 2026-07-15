@extends('layouts.public')

@section('title', 'Produk')

@section('content')
    {{-- Header --}}
    <section class="bg-gradient-to-br from-emerald-600 to-emerald-800 py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">Katalog Produk</h1>
            <p class="text-emerald-100/80 max-w-xl mx-auto">Jelajahi koleksi lengkap peralatan rumah tangga berkualitas tinggi kami</p>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-10 md:py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Search & Filter Bar --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 md:p-6 mb-8">
                <form action="{{ route('public.products') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    {{-- Search --}}
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                    </div>

                    {{-- Category Filter --}}
                    <div class="md:w-56">
                        <select name="category" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition appearance-none cursor-pointer">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex gap-2">
                        <button type="submit" class="inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-xl shadow-sm transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Cari
                        </button>
                        @if(request('search') || request('category'))
                            <a href="{{ route('public.products') }}" class="inline-flex items-center justify-center bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold px-4 py-3 rounded-xl transition">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Active Filters --}}
            @if(request('search') || request('category'))
                <div class="flex items-center flex-wrap gap-2 mb-6">
                    <span class="text-sm text-slate-500">Filter aktif:</span>
                    @if(request('search'))
                        <span class="inline-flex items-center bg-emerald-100 text-emerald-700 text-xs font-semibold px-3 py-1.5 rounded-lg">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            "{{ request('search') }}"
                        </span>
                    @endif
                    @if(request('category'))
                        <span class="inline-flex items-center bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1.5 rounded-lg">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            {{ request('category') }}
                        </span>
                    @endif
                    <span class="text-sm text-slate-400">—</span>
                    <span class="text-sm text-slate-500">{{ $products->total() }} produk ditemukan</span>
                </div>
            @endif

            {{-- Product Grid --}}
            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5">
                    @foreach($products as $product)
                        <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:border-emerald-200 hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col justify-between">
                            <div>
                                {{-- Product Image --}}
                                <div class="relative aspect-square overflow-hidden bg-slate-100">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy">

                                    {{-- Category Badge --}}
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-white/90 backdrop-blur-sm text-slate-600 text-xs font-semibold px-2 py-1 rounded-lg shadow-sm">
                                            {{ $product->category->name }}
                                        </span>
                                    </div>

                                    {{-- Stock Badge --}}
                                    @if($product->stock <= 10 && $product->stock > 0)
                                        <div class="absolute top-3 right-3">
                                            <span class="bg-amber-500 text-white text-xs font-bold px-2 py-1 rounded-lg shadow">
                                                Sisa {{ $product->stock }}
                                            </span>
                                        </div>
                                    @elseif($product->stock == 0)
                                        <div class="absolute top-3 right-3">
                                            <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-lg shadow">
                                                Habis
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Product Info --}}
                                <div class="p-4">
                                    <h3 class="text-sm font-bold text-slate-800 group-hover:text-emerald-600 transition-colors line-clamp-2 mb-1.5">
                                        {{ $product->name }}
                                    </h3>
                                    @if($product->description)
                                        <p class="text-xs text-slate-400 line-clamp-2 mb-2">{{ $product->description }}</p>
                                    @endif
                                    <p class="text-emerald-600 font-bold text-base">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                    @if($product->stock > 0)
                                        <p class="text-xs text-slate-400 mt-1">Stok: {{ $product->stock }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="p-4 pt-0">
                                @if($product->stock > 0)
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 rounded-xl text-xs transition">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                            + Keranjang
                                        </button>
                                    </form>
                                @else
                                    <button class="w-full inline-flex items-center justify-center bg-slate-100 text-slate-400 font-bold py-2 rounded-xl text-xs cursor-not-allowed" disabled>
                                        Stok Habis
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            @else
                {{-- Empty State --}}
                <div class="text-center py-20">
                    <div class="w-24 h-24 mx-auto bg-slate-100 rounded-3xl flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-700 mb-2">Produk Tidak Ditemukan</h3>
                    <p class="text-slate-400 mb-6 max-w-md mx-auto">Maaf, tidak ada produk yang cocok dengan pencarian Anda. Coba ubah kata kunci atau filter kategori.</p>
                    <a href="{{ route('public.products') }}" class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-xl shadow transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Reset Pencarian
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
