@extends('layouts.admin')

@section('title', 'Detail Produk - ' . $product->name)
@section('page-title', 'Detail Produk')

@section('breadcrumbs')
<nav class="flex text-sm text-slate-500 font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition">Dashboard</a>
    <span class="mx-2 text-slate-400">/</span>
    <a href="{{ route('admin.products.index') }}" class="hover:text-emerald-600 transition">Produk</a>
    <span class="mx-2 text-slate-400">/</span>
    <span class="text-slate-800 font-semibold">{{ $product->sku }}</span>
</nav>
@endsection

@section('content')
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden max-w-4xl">
    <!-- Header with action buttons -->
    <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center text-slate-600 hover:text-slate-900 text-sm font-semibold transition">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar
        </a>
        <div class="flex items-center space-x-2">
            <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold px-4 py-2 rounded-xl transition duration-150">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Edit
            </a>
            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete-confirm inline-flex items-center bg-red-50 hover:bg-red-100 text-red-700 text-sm font-semibold px-4 py-2 rounded-xl transition duration-150">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <!-- Product details content -->
    <div class="p-6 md:p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left: Product Image -->
            <div class="md:col-span-1">
                <div class="aspect-square bg-slate-50 border border-slate-200/80 rounded-2xl overflow-hidden flex items-center justify-center">
                    @if ($product->image)
                        <img src="{{ $product->image_url }}" class="w-full h-full object-cover">
                    @else
                        <!-- Big fallback illustration -->
                        <div class="text-center p-6">
                            <svg class="w-16 h-16 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <span class="text-xs text-slate-400 font-semibold block uppercase">Tidak ada foto</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right: Product Specifications -->
            <div class="md:col-span-2 space-y-6">
                <div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 mb-2">
                        {{ $product->category->name }}
                    </span>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">{{ $product->name }}</h2>
                    <p class="text-sm font-mono text-slate-400 mt-1 font-semibold">SKU: {{ $product->sku }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4 border-t border-b border-slate-100 py-5">
                    <!-- Price Card -->
                    <div class="bg-slate-50/50 p-4 rounded-xl border border-slate-100">
                        <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider block">Harga Jual</span>
                        <span class="text-xl font-bold text-slate-800 block mt-1">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>

                    <!-- Stock Card -->
                    <div class="bg-slate-50/50 p-4 rounded-xl border border-slate-100">
                        <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider block">Ketersediaan Stok</span>
                        @if ($product->stock <= 10)
                            <span class="text-xl font-bold text-red-600 block mt-1">{{ $product->stock }} unit <span class="text-xs text-red-400 font-medium">(Hampir Habis)</span></span>
                        @else
                            <span class="text-xl font-bold text-slate-800 block mt-1">{{ $product->stock }} unit</span>
                        @endif
                    </div>
                </div>

                <!-- Technical Details Table -->
                <div class="space-y-3">
                    <h4 class="text-sm font-bold text-slate-700">Informasi Tambahan</h4>
                    <div class="border border-slate-100 rounded-xl overflow-hidden text-sm">
                        <div class="flex border-b border-slate-100 bg-slate-50/30">
                            <span class="w-36 px-4 py-3 text-slate-400 font-semibold">Status</span>
                            <span class="flex-1 px-4 py-3 font-semibold text-slate-800">
                                @if ($product->is_active)
                                    <span class="text-emerald-600">Aktif (Tampil di Landing Page)</span>
                                @else
                                    <span class="text-slate-400">Nonaktif (Sembunyi dari Landing Page)</span>
                                @endif
                            </span>
                        </div>
                        <div class="flex border-b border-slate-100">
                            <span class="w-36 px-4 py-3 text-slate-400 font-semibold">Tanggal Input</span>
                            <span class="flex-1 px-4 py-3 text-slate-700 font-medium">{{ $product->created_at->isoFormat('D MMMM YYYY HH:mm') }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-36 px-4 py-3 text-slate-400 font-semibold">Terakhir Diubah</span>
                            <span class="flex-1 px-4 py-3 text-slate-700 font-medium">{{ $product->updated_at->isoFormat('D MMMM YYYY HH:mm') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Description Section -->
        <div class="mt-8 pt-8 border-t border-slate-100">
            <h3 class="text-base font-bold text-slate-800 mb-3">Deskripsi Produk</h3>
            <div class="text-slate-600 leading-relaxed text-sm whitespace-pre-line">
                {{ $product->description ?? 'Tidak ada deskripsi untuk produk ini.' }}
            </div>
        </div>
    </div>
</div>
@endsection
