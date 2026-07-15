<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - LukmanMart</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between text-slate-700 bg-slate-50" x-data="{ mobileMenuOpen: false }">

    <!-- Public Navbar -->
    <nav class="bg-white border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Brand/Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="p-1.5 bg-emerald-600 rounded-lg text-white shadow">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <span class="font-bold text-lg text-slate-800 tracking-wide uppercase">LukmanMart</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8 text-sm font-semibold">
                    <a href="{{ route('home') }}" class="transition {{ request()->routeIs('home') ? 'text-emerald-600 font-bold' : 'text-slate-500 hover:text-slate-800' }}">Home</a>
                    <a href="{{ route('public.products') }}" class="transition {{ request()->routeIs('public.products') ? 'text-emerald-600 font-bold' : 'text-slate-500 hover:text-slate-800' }}">Produk</a>
                    <a href="{{ route('public.about') }}" class="transition {{ request()->routeIs('public.about') ? 'text-emerald-600 font-bold' : 'text-slate-500 hover:text-slate-800' }}">Tentang</a>
                    <a href="{{ route('public.contact') }}" class="transition {{ request()->routeIs('public.contact') ? 'text-emerald-600 font-bold' : 'text-slate-500 hover:text-slate-800' }}">Kontak</a>
                    
                    {{-- Cart Link --}}
                    <a href="{{ route('cart.index') }}" class="relative flex items-center text-slate-500 hover:text-emerald-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        @if(count(session('cart', [])) > 0)
                            <span class="absolute -top-2 -right-3.5 bg-emerald-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow-sm">{{ count(session('cart', [])) }}</span>
                        @endif
                    </a>
                </div>

                <!-- Auth Action Buttons -->
                <div class="hidden md:flex items-center space-x-3">
                    @auth
                        @if(Auth::user()->email === 'admin@gmail.com')
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-bold px-4 py-2.5 rounded-xl transition">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                                </svg>
                                Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('customer.profile') }}" class="inline-flex items-center bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-bold px-4 py-2.5 rounded-xl transition">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profil Saya
                            </a>
                            <a href="{{ route('customer.orders') }}" class="inline-flex items-center text-slate-500 hover:text-emerald-600 text-xs font-bold px-3 py-2.5 transition">
                                Riwayat Pesanan
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold px-4 py-2.5 rounded-xl transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold px-4 py-2.5 rounded-xl transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-sm transition">
                            Daftar
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden space-x-3">
                    <a href="{{ route('cart.index') }}" class="relative text-slate-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        @if(count(session('cart', [])) > 0)
                            <span class="absolute -top-2 -right-3.5 bg-emerald-500 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-full shadow-sm">{{ count(session('cart', [])) }}</span>
                        @endif
                    </a>
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-slate-500 hover:text-slate-800 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div x-show="mobileMenuOpen" class="md:hidden border-t border-slate-100 bg-white" style="display: none;">
            <div class="px-2 pt-2 pb-4 space-y-1 text-sm font-semibold">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50' }}">Home</a>
                <a href="{{ route('public.products') }}" class="block px-3 py-2 rounded-lg {{ request()->routeIs('public.products') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50' }}">Produk</a>
                <a href="{{ route('public.about') }}" class="block px-3 py-2 rounded-lg {{ request()->routeIs('public.about') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50' }}">Tentang</a>
                <a href="{{ route('public.contact') }}" class="block px-3 py-2 rounded-lg {{ request()->routeIs('public.contact') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50' }}">Kontak</a>
                
                <div class="border-t border-slate-100 my-2 pt-2"></div>
                
                @auth
                    @if(Auth::user()->email === 'admin@gmail.com')
                        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg bg-emerald-50 text-emerald-700">Dashboard Admin</a>
                    @else
                        <a href="{{ route('customer.profile') }}" class="block px-3 py-2 rounded-lg bg-emerald-50 text-emerald-700">Profil Saya</a>
                        <a href="{{ route('customer.orders') }}" class="block px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-50">Riwayat Pesanan</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="block w-full">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 rounded-lg text-rose-600 hover:bg-rose-50">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-50">Login</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-lg bg-emerald-600 text-white text-center shadow">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Public Footer -->
    <footer class="bg-emerald-950 text-emerald-100 border-t border-emerald-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand Col -->
                <div class="space-y-4 col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2">
                        <div class="p-1.5 bg-emerald-500 rounded-lg text-emerald-950 shadow">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <span class="font-bold text-lg text-white tracking-wide uppercase">LukmanMart</span>
                    </div>
                    <p class="text-sm text-emerald-300 max-w-sm">
                        Menyediakan produk peralatan rumah tangga modern, minimalis, dan berkualitas tinggi untuk menunjang kebersihan serta kenyamanan rumah Anda.
                    </p>
                </div>

                <!-- Nav Links Col -->
                <div>
                    <h4 class="text-white font-bold text-sm tracking-wider uppercase mb-4">Navigasi</h4>
                    <ul class="space-y-2.5 text-sm font-semibold">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('public.products') }}" class="hover:text-white transition">Produk</a></li>
                        <li><a href="{{ route('public.about') }}" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="{{ route('public.contact') }}" class="hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>

                <!-- Contact Info Col -->
                <div>
                    <h4 class="text-white font-bold text-sm tracking-wider uppercase mb-4">Kontak Kami</h4>
                    <ul class="space-y-2.5 text-sm text-emerald-300">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Jl. Kebersihan No. 12, DKI Jakarta</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>(021) 1234-5678</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Border Divider -->
            <div class="border-t border-emerald-900/60 my-8"></div>

            <!-- copyright -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-xs text-emerald-400">
                <span>&copy; {{ date('Y') }} LukmanMart. All Rights Reserved.</span>
                <span class="mt-2 sm:mt-0">Designed with modern minimalism.</span>
            </div>
        </div>
    </footer>

</body>
</html>
