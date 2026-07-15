@extends('layouts.public')

@section('title', 'Kontak')

@section('content')
    {{-- Header --}}
    <section class="bg-gradient-to-br from-emerald-600 to-emerald-800 py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">Hubungi Kami</h1>
            <p class="text-emerald-100/80 max-w-xl mx-auto">Ada pertanyaan atau saran? Jangan ragu untuk menghubungi kami</p>
        </div>
    </section>

    {{-- Contact Section --}}
    <section class="py-16 md:py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">
                {{-- Contact Info --}}
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <span class="inline-flex items-center bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full mb-3">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Informasi Kontak
                        </span>
                        <h2 class="text-2xl font-bold text-slate-800">Cara Menghubungi Kami</h2>
                        <p class="text-slate-500 mt-2">Kami selalu siap membantu Anda. Hubungi kami melalui salah satu cara di bawah ini.</p>
                    </div>

                    {{-- Address --}}
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 mb-1">Alamat</h3>
                                <p class="text-sm text-slate-500">Jl. Kebersihan No. 12, Kelurahan Bersih, Kecamatan Rapi, DKI Jakarta 10110</p>
                            </div>
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 mb-1">Telepon</h3>
                                <p class="text-sm text-slate-500">(021) 1234-5678</p>
                                <p class="text-sm text-slate-500">+62 812-3456-7890</p>
                            </div>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 mb-1">Email</h3>
                                <p class="text-sm text-slate-500">info@lukmanmart.com</p>
                                <p class="text-sm text-slate-500">support@lukmanmart.com</p>
                            </div>
                        </div>
                    </div>

                    {{-- Operating Hours --}}
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 mb-1">Jam Operasional</h3>
                                <div class="space-y-1 text-sm text-slate-500">
                                    <p>Senin - Jumat: 08.00 - 17.00 WIB</p>
                                    <p>Sabtu: 08.00 - 14.00 WIB</p>
                                    <p>Minggu & Hari Libur: Tutup</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contact Form --}}
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100">
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-slate-800 mb-2">Kirim Pesan</h2>
                            <p class="text-sm text-slate-500">Isi formulir di bawah ini dan kami akan segera menghubungi Anda kembali.</p>
                        </div>

                        <form class="space-y-5">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                {{-- Name --}}
                                <div>
                                    <label for="contact-name" class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                                    <input type="text" id="contact-name" placeholder="Masukkan nama Anda" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                                </div>

                                {{-- Email --}}
                                <div>
                                    <label for="contact-email" class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                                    <input type="email" id="contact-email" placeholder="nama@email.com" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                                </div>
                            </div>

                            {{-- Subject --}}
                            <div>
                                <label for="contact-subject" class="block text-sm font-semibold text-slate-700 mb-2">Subjek</label>
                                <input type="text" id="contact-subject" placeholder="Topik pesan Anda" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                            </div>

                            {{-- Message --}}
                            <div>
                                <label for="contact-message" class="block text-sm font-semibold text-slate-700 mb-2">Pesan</label>
                                <textarea id="contact-message" rows="6" placeholder="Tulis pesan Anda di sini..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition resize-none"></textarea>
                            </div>

                            {{-- Submit --}}
                            <div class="flex items-center justify-between">
                                <p class="text-xs text-slate-400">* Semua field wajib diisi</p>
                                <button type="button" onclick="alert('Terima kasih! Pesan Anda telah dikirim.')" class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-8 py-3 rounded-xl shadow-sm hover:shadow transition-all duration-300">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    Kirim Pesan
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Map Placeholder --}}
                    <div class="mt-8 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                        <div class="bg-gradient-to-br from-slate-100 to-slate-200 h-64 flex items-center justify-center">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-sm">
                                    <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-slate-600">Lokasi Toko</p>
                                <p class="text-xs text-slate-400 mt-1">Jl. Kebersihan No. 12, DKI Jakarta</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
