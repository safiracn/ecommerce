@extends('layouts.admin')

@section('title', 'Daftar Kategori')
@section('page-title', 'Kategori')

@section('breadcrumbs')
<nav class="flex text-sm text-slate-500 font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition">Dashboard</a>
    <span class="mx-2 text-slate-400">/</span>
    <span class="text-emerald-600">Kategori</span>
</nav>
@endsection

@section('actions')
<a href="{{ route('admin.categories.create') }}" class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl shadow-md hover:shadow-lg transition duration-200">
    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
    </svg>
    Tambah Kategori
</a>
@endsection

@section('content')
<!-- Table & Filter Section -->
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    <!-- Header Controls -->
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-slate-50/50">
        <!-- Search form -->
        <form method="GET" action="{{ route('admin.categories.index') }}" class="w-full md:w-96">
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       class="pl-11 pr-4 block w-full rounded-xl border border-slate-200 bg-white py-2 text-sm text-slate-800 placeholder-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition duration-200" 
                       placeholder="Cari kategori...">
            </div>
            @if (request('search') || request('sort'))
                <input type="hidden" name="sort" value="{{ request('sort') }}">
                <input type="hidden" name="order" value="{{ request('order') }}">
            @endif
        </form>

        <!-- Sorting Selector -->
        <div class="flex items-center space-x-2">
            <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Urutkan:</span>
            <div class="inline-flex rounded-xl border border-slate-200 bg-white p-1">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'order' => request('order') === 'asc' && request('sort') === 'name' ? 'desc' : 'asc']) }}" 
                   class="px-3 py-1.5 text-xs font-semibold rounded-lg transition {{ request('sort') === 'name' ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:text-slate-900' }}">
                    Nama {!! request('sort') === 'name' ? (request('order') === 'asc' ? '↑' : '↓') : '' !!}
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'order' => request('order') === 'asc' && request('sort') === 'created_at' ? 'desc' : 'asc']) }}" 
                   class="px-3 py-1.5 text-xs font-semibold rounded-lg transition {{ request('sort') === 'created_at' || !request('sort') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:text-slate-900' }}">
                    Tanggal {!! request('sort') === 'created_at' || !request('sort') ? (request('order') === 'asc' ? '↑' : '↓') : '' !!}
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'products_count', 'order' => request('order') === 'asc' && request('sort') === 'products_count' ? 'desc' : 'asc']) }}" 
                   class="px-3 py-1.5 text-xs font-semibold rounded-lg transition {{ request('sort') === 'products_count' ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:text-slate-900' }}">
                    Produk {!! request('sort') === 'products_count' ? (request('order') === 'asc' ? '↑' : '↓') : '' !!}
                </a>
            </div>
        </div>
    </div>

    <!-- Table content -->
    <div class="overflow-x-auto">
        @if ($categories->isEmpty())
            <div class="p-12 flex flex-col items-center justify-center text-slate-400">
                <svg class="w-16 h-16 mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <p class="text-base font-semibold">Kategori tidak ditemukan</p>
                <p class="text-sm mt-1">Coba sesuaikan kata kunci pencarian Anda.</p>
                @if (request('search'))
                    <a href="{{ route('admin.categories.index') }}" class="mt-4 inline-flex items-center text-emerald-600 hover:text-emerald-700 font-semibold text-sm">
                        Bersihkan Pencarian
                    </a>
                @endif
            </div>
        @else
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider bg-slate-50/30">
                        <th class="py-4 px-6">Nama Kategori</th>
                        <th class="py-4 px-6">Slug</th>
                        <th class="py-4 px-6">Deskripsi</th>
                        <th class="py-4 px-6 text-center">Jumlah Produk</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @foreach ($categories as $category)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="py-4 px-6 font-semibold text-slate-800">{{ $category->name }}</td>
                            <td class="py-4 px-6 text-slate-500 font-mono text-xs">{{ $category->slug }}</td>
                            <td class="py-4 px-6 text-slate-600 max-w-xs truncate" title="{{ $category->description }}">
                                {{ $category->description ?? '-' }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/10">
                                    {{ $category->products_count }} produk
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right space-x-1">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="inline-flex items-center p-2 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition duration-150" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete-confirm inline-flex items-center p-2 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition duration-150" title="Hapus">
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
    @if ($categories->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $categories->links() }}
        </div>
    @endif
</div>
@endsection
