@extends('layouts.admin')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')

@section('breadcrumbs')
<nav class="flex text-sm text-slate-500 font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition">Dashboard</a>
    <span class="mx-2 text-slate-400">/</span>
    <a href="{{ route('admin.categories.index') }}" class="hover:text-emerald-600 transition">Kategori</a>
    <span class="mx-2 text-slate-400">/</span>
    <span class="text-emerald-600">Tambah</span>
</nav>
@endsection

@section('content')
<div class="max-w-2xl bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
        <h3 class="font-bold text-slate-800">Form Kategori Baru</h3>
        <p class="text-xs text-slate-400 mt-1">Masukkan data kategori peralatan rumah tangga yang baru.</p>
    </div>
    
    <form method="POST" action="{{ route('admin.categories.store') }}" class="p-6 space-y-6">
        @csrf

        <!-- Category Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nama Kategori</label>
            <input type="text" 
                   name="name" 
                   id="name"
                   value="{{ old('name') }}" 
                   required
                   class="block w-full rounded-xl border border-slate-200 bg-slate-50/30 py-2.5 px-3.5 text-slate-800 placeholder-slate-400 focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition duration-200 @error('name') border-red-500 focus:border-red-500 focus:ring-red-500/10 @enderror" 
                   placeholder="Masukkan nama kategori (e.g. Alat Dapur)">
            @error('name')
                <p class="mt-2 text-xs font-semibold text-red-600 flex items-center">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi</label>
            <textarea name="description" 
                      id="description" 
                      rows="4"
                      class="block w-full rounded-xl border border-slate-200 bg-slate-50/30 py-2.5 px-3.5 text-slate-800 placeholder-slate-400 focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition duration-200 @error('description') border-red-500 focus:border-red-500 focus:ring-red-500/10 @enderror"
                      placeholder="Masukkan deskripsi penjelasan kategori...">{{ old('description') }}</textarea>
            @error('description')
                <p class="mt-2 text-xs font-semibold text-red-600 flex items-center">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
            <a href="{{ route('admin.categories.index') }}" class="px-4 py-2.5 border border-slate-200 hover:bg-slate-50 text-slate-600 text-sm font-semibold rounded-xl transition duration-150 flex items-center">
                Batal
            </a>
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                Simpan Kategori
            </button>
        </div>
    </form>
</div>
@endsection
