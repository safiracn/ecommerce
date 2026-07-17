@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('breadcrumbs')
<nav class="flex text-sm text-slate-500 font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition">Dashboard</a>
    <span class="mx-2 text-slate-400">/</span>
    <a href="{{ route('admin.products.index') }}" class="hover:text-emerald-600 transition">Produk</a>
    <span class="mx-2 text-slate-400">/</span>
    <span class="text-emerald-600">Edit</span>
</nav>
@endsection

@section('content')
<div class="max-w-4xl bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
        <h3 class="font-bold text-slate-800">Ubah Rincian Produk</h3>
        <p class="text-xs text-slate-400 mt-1">Ubah data informasi produk peralatan rumah tangga.</p>
    </div>

    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="p-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Side Inputs -->
            <div class="space-y-6">
                <!-- Product Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nama Produk</label>
                    <input type="text" 
                           name="name" 
                           id="name"
                           value="{{ old('name', $product->name) }}" 
                           required
                           class="block w-full rounded-xl border border-slate-200 bg-slate-50/30 py-2.5 px-3.5 text-slate-800 placeholder-slate-400 focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition duration-200 @error('name') border-red-500 focus:border-red-500 focus:ring-red-500/10 @enderror" 
                           placeholder="Masukkan nama produk">
                    @error('name')
                        <p class="mt-2 text-xs font-semibold text-red-600 flex items-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
                    <select name="category_id" 
                            id="category_id" 
                            required
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50/30 py-2.5 px-3.5 text-slate-700 placeholder-slate-400 focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition duration-200 @error('category_id') border-red-500 focus:border-red-500 focus:ring-red-500/10 @enderror">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-2 text-xs font-semibold text-red-600 flex items-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Price and Stock Row -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-semibold text-slate-700 mb-2">Harga (Rp)</label>
                        <input type="number" 
                               name="price" 
                               id="price"
                               value="{{ old('price', intval($product->price)) }}" 
                               required
                               min="0"
                               class="block w-full rounded-xl border border-slate-200 bg-slate-50/30 py-2.5 px-3.5 text-slate-800 placeholder-slate-400 focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition duration-200 @error('price') border-red-500 focus:border-red-500 focus:ring-red-500/10 @enderror" 
                               placeholder="e.g. 35000">
                        @error('price')
                            <p class="mt-2 text-xs font-semibold text-red-600 flex items-center">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div>
                        <label for="stock" class="block text-sm font-semibold text-slate-700 mb-2">Stok</label>
                        <input type="number" 
                               name="stock" 
                               id="stock"
                               value="{{ old('stock', $product->stock) }}" 
                               required
                               min="0"
                               class="block w-full rounded-xl border border-slate-200 bg-slate-50/30 py-2.5 px-3.5 text-slate-800 placeholder-slate-400 focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition duration-200 @error('stock') border-red-500 focus:border-red-500 focus:ring-red-500/10 @enderror" 
                               placeholder="e.g. 50">
                        @error('stock')
                            <p class="mt-2 text-xs font-semibold text-red-600 flex items-center">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Status Checkbox -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Status Produk</label>
                    <div class="flex items-center">
                        <input id="is_active" type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="w-4 h-4 rounded text-emerald-600 border-slate-300 focus:ring-emerald-500 focus:ring-offset-0 transition">
                        <label for="is_active" class="ml-2 text-sm text-slate-600 font-semibold select-none cursor-pointer">Aktifkan produk agar tampil di landing page</label>
                    </div>
                </div>
            </div>

            <!-- Right Side (Image Upload and Description) -->
            <div class="space-y-6 flex flex-col justify-between">
                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Produk</label>
                    <textarea name="description" 
                              id="description" 
                              rows="5"
                              class="block w-full rounded-xl border border-slate-200 bg-slate-50/30 py-2.5 px-3.5 text-slate-800 placeholder-slate-400 focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition duration-200 @error('description') border-red-500 focus:border-red-500 focus:ring-red-500/10 @enderror"
                              placeholder="Masukkan deskripsi produk secara detail...">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-xs font-semibold text-red-600 flex items-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Image Upload with Preview -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Foto Produk</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-2xl bg-slate-50/50 hover:bg-slate-50 transition relative">
                        <div class="space-y-1 text-center {{ $product->image ? 'hidden' : '' }}" id="uploadPrompt">
                            <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h16a4 4 0 004-4V12a4 4 0 00-4-4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M14 29l7-7 7 7M14 26l7-7 7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="18" cy="18" r="3" stroke-width="2" />
                            </svg>
                            <div class="flex text-sm text-slate-600">
                                <label for="image" class="relative cursor-pointer bg-transparent rounded-md font-semibold text-emerald-600 hover:text-emerald-700 focus-within:outline-none">
                                    <span>Unggah foto baru</span>
                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                </label>
                                <p class="pl-1">atau seret dan lepas</p>
                            </div>
                            <p class="text-xs text-slate-400">PNG, JPG, JPEG sampai dengan 2MB</p>
                        </div>
                        
                        <!-- Image Preview Element -->
                        <div class="{{ $product->image ? '' : 'hidden' }} absolute inset-0 w-full h-full p-2 bg-white rounded-2xl flex items-center justify-center" id="previewContainer">
                            <img src="{{ $product->image_url }}" id="imagePreview" class="max-h-full max-w-full rounded-xl object-contain shadow-sm">
                            <button type="button" id="removeImageBtn" class="absolute top-4 right-4 bg-red-600 hover:bg-red-700 text-white p-2 rounded-xl shadow-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @error('image')
                        <p class="mt-2 text-xs font-semibold text-red-600 flex items-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end space-x-3 pt-6 border-t border-slate-100">
            <a href="{{ route('admin.products.index') }}" class="px-4 py-2.5 border border-slate-200 hover:bg-slate-50 text-slate-600 text-sm font-semibold rounded-xl transition duration-150 flex items-center">
                Batal
            </a>
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                Perbarui Produk
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const imageInput = document.getElementById('image');
        const uploadPrompt = document.getElementById('uploadPrompt');
        const previewContainer = document.getElementById('previewContainer');
        const imagePreview = document.getElementById('imagePreview');
        const removeImageBtn = document.getElementById('removeImageBtn');

        // File upload change listener
        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    uploadPrompt.classList.add('hidden');
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Remove image action
        removeImageBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            imageInput.value = '';
            imagePreview.src = '';
            previewContainer.classList.add('hidden');
            uploadPrompt.classList.remove('hidden');
        });
    });
</script>
@endsection
