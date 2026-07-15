@extends('layouts.public')

@section('title', 'Profil Saya')

@section('content')
<section class="py-12 bg-slate-50 min-h-[calc(100vh-16rem)]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-slate-800 tracking-tight mb-8">Profil Saya</h1>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center">
                <svg class="w-5 h-5 mr-3 flex-shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Navigation / User Card --}}
            <div class="md:col-span-1 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center text-center space-y-4">
                <img src="{{ $customer->avatar ? asset('storage/' . $customer->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($customer->name) . '&background=16A34A&color=fff' }}" alt="Avatar" class="w-24 h-24 rounded-full object-cover border-2 border-emerald-500 shadow-sm">
                
                <div>
                    <h2 class="font-bold text-slate-800 text-lg">{{ $customer->name }}</h2>
                    <p class="text-slate-400 text-xs">{{ $customer->email }}</p>
                </div>

                <div class="w-full border-t border-slate-100 pt-4 flex flex-col gap-2">
                    <a href="{{ route('customer.profile') }}" class="w-full inline-flex justify-center bg-emerald-50 text-emerald-700 font-bold px-4 py-2.5 rounded-xl text-xs transition">
                        Edit Profil
                    </a>
                    <a href="{{ route('customer.orders') }}" class="w-full inline-flex justify-center bg-slate-50 hover:bg-slate-100 text-slate-600 font-bold px-4 py-2.5 rounded-xl text-xs transition">
                        Riwayat Pesanan
                    </a>
                </div>
            </div>

            {{-- Profile Edit Form --}}
            <div class="md:col-span-2 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                <form action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $customer->name) }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition" required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $customer->email) }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition" required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nomor Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Pengiriman Default</label>
                        <textarea name="address" rows="3" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition resize-none">{{ old('address', $customer->address) }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Avatar Profil</label>
                        <input type="file" name="avatar" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                        @error('avatar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="border-t border-slate-100 pt-5 flex justify-end">
                        <button type="submit" class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-xl shadow-sm hover:shadow transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                            </svg>
                            Simpan Profil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
