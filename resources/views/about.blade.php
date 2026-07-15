@extends('layouts.public')

@section('title', 'Tentang Kami')

@section('content')
    {{-- Header --}}
    <section class="bg-gradient-to-br from-emerald-600 to-emerald-800 py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">Tentang Kami</h1>
            <p class="text-emerald-100/80 max-w-xl mx-auto">Mengenal lebih dekat LukmanMart dan komitmen kami</p>
        </div>
    </section>

    {{-- About Section --}}
    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                {{-- Illustration --}}
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-emerald-100 rounded-3xl blur-xl opacity-60"></div>
                        <div class="relative bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-3xl p-12 border border-emerald-200">
                            <svg class="w-48 h-48 md:w-64 md:h-64 text-emerald-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Content --}}
                <div class="space-y-6">
                    <div>
                        <span class="inline-flex items-center bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full mb-3">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Siapa Kami
                        </span>
                        <h2 class="text-3xl md:text-4xl font-bold text-slate-800 tracking-tight">LukmanMart</h2>
                    </div>
                    <p class="text-slate-600 leading-relaxed">
                        <strong class="text-slate-800">LukmanMart</strong> adalah toko peralatan rumah tangga modern yang menyediakan berbagai kebutuhan rumah tangga berkualitas tinggi. Didirikan dengan semangat memberikan produk terbaik untuk setiap keluarga Indonesia.
                    </p>
                    <p class="text-slate-600 leading-relaxed">
                        Kami percaya bahwa rumah yang bersih dan rapi adalah fondasi dari kehidupan yang nyaman. Oleh karena itu, kami secara selektif memilih produk-produk yang tidak hanya fungsional, tetapi juga memiliki desain modern dan daya tahan tinggi.
                    </p>
                    <p class="text-slate-600 leading-relaxed">
                        Mulai dari peralatan kebersihan, alat dapur, tempat penyimpanan, hingga perlengkapan rumah tangga lainnya — semua tersedia di LukmanMart dengan harga yang kompetitif dan kualitas yang terjamin.
                    </p>

                    {{-- Stats Row --}}
                    <div class="grid grid-cols-3 gap-4 pt-4">
                        <div class="text-center bg-slate-50 rounded-2xl p-4 border border-slate-100">
                            <span class="text-2xl font-bold text-emerald-600">50+</span>
                            <p class="text-xs text-slate-500 mt-1">Produk</p>
                        </div>
                        <div class="text-center bg-slate-50 rounded-2xl p-4 border border-slate-100">
                            <span class="text-2xl font-bold text-emerald-600">10+</span>
                            <p class="text-xs text-slate-500 mt-1">Kategori</p>
                        </div>
                        <div class="text-center bg-slate-50 rounded-2xl p-4 border border-slate-100">
                            <span class="text-2xl font-bold text-emerald-600">100%</span>
                            <p class="text-xs text-slate-500 mt-1">Original</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Vision & Mission --}}
    <section class="py-16 md:py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="inline-flex items-center bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full mb-3">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Visi & Misi
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 tracking-tight">Arah & Tujuan Kami</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Visi --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
                    <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-4">Visi</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Menjadi toko peralatan rumah tangga terdepan dan terpercaya di Indonesia yang menyediakan produk berkualitas tinggi untuk setiap rumah tangga, sehingga setiap keluarga dapat menikmati kenyamanan dan kebersihan rumah secara optimal.
                    </p>
                </div>

                {{-- Misi --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-4">Misi</h3>
                    <ul class="space-y-3 text-slate-600">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-2.5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Menyediakan produk rumah tangga modern, minimalis, dan berkualitas tinggi.</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-2.5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Memberikan harga yang kompetitif dan terjangkau untuk semua kalangan.</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-2.5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Memastikan kepuasan pelanggan melalui pelayanan yang ramah dan profesional.</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-2.5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Terus berinovasi dalam memperbarui katalog produk sesuai tren dan kebutuhan pasar.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Core Values --}}
    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="inline-flex items-center bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full mb-3">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    Nilai-Nilai Kami
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 tracking-tight">Prinsip yang Kami Pegang</h2>
                <p class="mt-3 text-slate-500 max-w-xl mx-auto">Nilai-nilai inti yang menjadi landasan setiap langkah kami</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Integritas --}}
                <div class="bg-slate-50 rounded-2xl p-7 border border-slate-100 hover:bg-white hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Integritas</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Kami menjamin keaslian dan kualitas setiap produk yang kami jual. Kepercayaan pelanggan adalah prioritas utama.</p>
                </div>

                {{-- Inovasi --}}
                <div class="bg-slate-50 rounded-2xl p-7 border border-slate-100 hover:bg-white hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Inovasi</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Kami terus berinovasi dalam menghadirkan produk-produk terbaru yang mengikuti perkembangan desain dan teknologi.</p>
                </div>

                {{-- Kepuasan Pelanggan --}}
                <div class="bg-slate-50 rounded-2xl p-7 border border-slate-100 hover:bg-white hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
                    <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Kepuasan Pelanggan</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Setiap pelanggan berhak mendapatkan pengalaman belanja yang menyenangkan dan produk yang memuaskan.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
