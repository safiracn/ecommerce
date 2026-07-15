@extends('layouts.public')

@section('title', 'Keranjang Belanja')

@section('content')
<section class="py-12 bg-slate-50 min-h-[calc(100vh-16rem)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-slate-800 tracking-tight mb-8">Keranjang Belanja</h1>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center">
                <svg class="w-5 h-5 mr-3 flex-shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl flex items-center">
                <svg class="w-5 h-5 mr-3 flex-shrink-0 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                {{-- Cart Items --}}
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cart as $item)
                        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-5">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-20 h-20 rounded-xl object-cover bg-slate-100 flex-shrink-0 border border-slate-100">
                            
                            <div class="flex-grow min-w-0">
                                <h3 class="font-bold text-slate-800 text-sm md:text-base line-clamp-1 mb-1">{{ $item['name'] }}</h3>
                                <p class="text-emerald-600 font-bold text-sm">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                <span class="text-xs text-slate-400">Stok: {{ $item['stock'] }}</span>
                            </div>

                            {{-- Quantity Update --}}
                            <div class="flex items-center gap-2">
                                <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="flex items-center gap-1.5 bg-slate-100 p-1.5 rounded-xl">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" class="p-1 hover:bg-white rounded-lg transition text-slate-500 hover:text-slate-800">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                        </svg>
                                    </button>
                                    <span class="px-2 text-sm font-semibold text-slate-700 w-6 text-center">{{ $item['quantity'] }}</span>
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="p-1 hover:bg-white rounded-lg transition text-slate-500 hover:text-slate-800" {{ $item['quantity'] >= $item['stock'] ? 'disabled' : '' }}>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </button>
                                </form>

                                {{-- Remove --}}
                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 hover:bg-rose-50 text-slate-400 hover:text-rose-600 rounded-xl transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Summary & Checkout Form --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 space-y-6">
                    <h2 class="font-bold text-slate-800 text-lg border-b border-slate-100 pb-3">Ringkasan Belanja</h2>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between text-slate-500">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        @if($discount > 0)
                            <div class="flex justify-between text-emerald-600 font-medium">
                                <span>Diskon Belanja</span>
                                <span>-Rp {{ number_format($discount, 0, ',', '.') }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between text-slate-500">
                            <span>Pajak (10%)</span>
                            <span>Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-slate-100 pt-3 flex justify-between font-bold text-slate-800 text-base">
                            <span>Total Harga</span>
                            <span class="text-emerald-600">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    @auth
                        {{-- Logged in: show checkout form --}}
                        <form action="{{ route('customer.checkout') }}" method="POST" class="border-t border-slate-100 pt-5 space-y-4">
                            @csrf
                            <h3 class="font-bold text-slate-700 text-sm">Detail Pengiriman</h3>
                            
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 mb-1.5">Nomor Telepon</label>
                                <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="Masukkan nomor telepon" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition" required>
                                @error('phone')
                                    <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 mb-1.5">Alamat Lengkap</label>
                                <textarea name="address" rows="3" placeholder="Alamat lengkap pengiriman" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition resize-none" required>{{ old('address', Auth::user()->address) }}</textarea>
                                @error('address')
                                    <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 mb-1.5">Catatan Pesanan (Opsional)</label>
                                <textarea name="notes" rows="2" placeholder="Catatan tambahan..." class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition resize-none"></textarea>
                            </div>

                            <button type="submit" class="w-full inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-6 rounded-xl shadow-sm hover:shadow transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                Bayar Sekarang
                            </button>
                        </form>
                    @else
                        {{-- Guest: show login prompt --}}
                        <div class="border-t border-slate-100 pt-5 text-center space-y-3">
                            <p class="text-xs text-slate-500 leading-relaxed">Anda harus login sebagai customer terlebih dahulu untuk melanjutkan proses checkout.</p>
                            <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-6 rounded-xl shadow-sm transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Login untuk Checkout
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        @else
            {{-- Empty Cart --}}
            <div class="text-center py-20 bg-white rounded-2xl border border-slate-100 shadow-sm max-w-2xl mx-auto">
                <div class="w-24 h-24 mx-auto bg-slate-50 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-slate-700 mb-2">Keranjang Anda Kosong</h2>
                <p class="text-slate-400 mb-6 text-sm max-w-sm mx-auto">Sepertinya Anda belum menambahkan produk apapun ke keranjang Anda.</p>
                <a href="{{ route('public.products') }}" class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-xl shadow-sm transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>
</section>
@endsection
