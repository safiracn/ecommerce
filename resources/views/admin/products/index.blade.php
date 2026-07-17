@extends('layouts.admin')

@section('title', 'Daftar Produk')
@section('page-title', 'Produk')

@section('breadcrumbs')
<nav class="flex text-sm text-slate-500 font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition">Dashboard</a>
    <span class="mx-2 text-slate-400">/</span>
    <span class="text-emerald-600">Produk</span>
</nav>
@endsection

@section('actions')
<a href="{{ route('admin.products.create') }}" class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl shadow-md hover:shadow-lg transition duration-200">
    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
    </svg>
    Tambah Produk
</a>
@endsection

@section('content')
<!-- Table & Filter Controls Section -->
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    <!-- Header Controls -->
    <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">
        <!-- Search and Filter Form -->
        <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-col md:flex-row gap-3 flex-1">
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
                       placeholder="Cari nama atau SKU produk...">
            </div>

            <!-- Category select -->
            <div class="w-full md:w-56">
                <select name="category_id" 
                        onchange="this.form.submit()"
                        class="block w-full rounded-xl border border-slate-200 bg-white py-2 px-3.5 text-sm text-slate-700 placeholder-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition duration-200">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if (request('search') || request('category_id') || request('sort'))
                <a href="{{ route('admin.products.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-slate-200 hover:bg-slate-50 text-slate-600 text-sm font-semibold rounded-xl transition duration-150">
                    Reset
                </a>
            @endif

            <!-- Retain sorting parameters on submit -->
            <input type="hidden" name="sort" value="{{ request('sort') }}">
            <input type="hidden" name="order" value="{{ request('order') }}">
        </form>

        <!-- Sorting -->
        <div class="flex items-center space-x-2">
            <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Urutkan:</span>
            <div class="inline-flex rounded-xl border border-slate-200 bg-white p-1">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'order' => request('order') === 'asc' && request('sort') === 'name' ? 'desc' : 'asc']) }}" 
                   class="px-3 py-1.5 text-xs font-semibold rounded-lg transition {{ request('sort') === 'name' ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:text-slate-900' }}">
                    Nama {!! request('sort') === 'name' ? (request('order') === 'asc' ? '↑' : '↓') : '' !!}
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'price', 'order' => request('order') === 'asc' && request('sort') === 'price' ? 'desc' : 'asc']) }}" 
                   class="px-3 py-1.5 text-xs font-semibold rounded-lg transition {{ request('sort') === 'price' ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:text-slate-900' }}">
                    Harga {!! request('sort') === 'price' ? (request('order') === 'asc' ? '↑' : '↓') : '' !!}
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'stock', 'order' => request('order') === 'asc' && request('sort') === 'stock' ? 'desc' : 'asc']) }}" 
                   class="px-3 py-1.5 text-xs font-semibold rounded-lg transition {{ request('sort') === 'stock' ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:text-slate-900' }}">
                    Stok {!! request('sort') === 'stock' ? (request('order') === 'asc' ? '↑' : '↓') : '' !!}
                </a>
            </div>
        </div>
    </div>

    <!-- Table Body -->
    <div class="overflow-x-auto">
        @if ($products->isEmpty())
            <div class="p-12 flex flex-col items-center justify-center text-slate-400">
                <svg class="w-16 h-16 mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <p class="text-base font-semibold">Produk tidak ditemukan</p>
                <p class="text-sm mt-1">Coba sesuaikan filter atau kata kunci pencarian Anda.</p>
            </div>
        @else
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider bg-slate-50/30">
                        <th class="py-4 px-6">Info Produk</th>
                        <th class="py-4 px-6">SKU</th>
                        <th class="py-4 px-6">Kategori</th>
                        <th class="py-4 px-6">Harga</th>
                        <th class="py-4 px-6 text-center">Stok</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @foreach ($products as $product)
                        <tr class="hover:bg-slate-50/50 transition">
                            <!-- Info & Image -->
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3.5">
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-100 overflow-hidden flex-shrink-0 flex items-center justify-center">
                                        @if ($product->image)
                                            <img src="{{ $product->image_url }}" class="w-full h-full object-cover">
                                        @else
                                            <!-- Fallback SVG icon for household equipment -->
                                            <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-800 leading-tight">{{ $product->name }}</h4>
                                        <p class="text-xs text-slate-400 mt-1">Dibuat: {{ $product->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- SKU -->
                            <td class="py-4 px-6 font-mono text-xs text-slate-500 font-semibold">{{ $product->sku }}</td>

                            <!-- Category -->
                            <td class="py-4 px-6 text-slate-600 font-medium">{{ $product->category->name }}</td>

                            <!-- Price -->
                            <td class="py-4 px-6 text-slate-800 font-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</td>

                            <!-- Stock -->
                            <td class="py-4 px-6 text-center">
                                @if ($product->stock <= 10)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 ring-1 ring-red-600/10">
                                        {{ $product->stock }} (Menipis)
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/10">
                                        {{ $product->stock }}
                                    </span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td class="py-4 px-6 text-center">
                                @if ($product->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 text-right space-x-1 whitespace-nowrap">
                                <a href="{{ route('admin.products.show', $product) }}" class="inline-flex items-center p-2 text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition" title="Lihat">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center p-2 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete-confirm inline-flex items-center p-2 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Pagination Footer -->
    @if ($products->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
