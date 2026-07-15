<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - HomeMart</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col items-center justify-center p-4">
    <div class="mb-4">
        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-emerald-600 transition">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Beranda
        </a>
    </div>

    <div class="w-full max-w-md bg-white rounded-3xl border border-slate-200/80 shadow-xl overflow-hidden">
        <!-- Banner/Logo Header -->
        <div class="bg-emerald-950 p-8 text-center text-white relative overflow-hidden">
            <!-- Background glow effect -->
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-emerald-500 rounded-full blur-3xl opacity-20"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-emerald-400 rounded-full blur-3xl opacity-20"></div>
            
            <div class="inline-flex p-3 bg-emerald-500 rounded-2xl text-emerald-950 shadow-lg mb-4 relative z-10">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold tracking-tight relative z-10">HomeMart</h2>
            <p class="text-sm text-emerald-300 mt-1 relative z-10">Masuk ke Akun Anda</p>
        </div>

        <!-- Form Container -->
        <div class="p-8 space-y-6">
            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                            </svg>
                        </span>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
                               autocomplete="username" 
                               class="pl-11 block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-3 text-slate-800 placeholder-slate-400 focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition duration-200 @error('email') border-red-500 focus:border-red-500 focus:ring-red-500/10 @enderror" 
                               placeholder="email@example.com">
                    </div>
                    @error('email')
                        <p class="mt-2 text-xs font-semibold text-red-600 flex items-center">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Kata Sandi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </span>
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required 
                               autocomplete="current-password" 
                               class="pl-11 block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-3 text-slate-800 placeholder-slate-400 focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition duration-200 @error('password') border-red-500 focus:border-red-500 focus:ring-red-500/10 @enderror" 
                               placeholder="••••••••">
                    </div>
                    @error('password')
                        <p class="mt-2 text-xs font-semibold text-red-600 flex items-center">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded-md text-emerald-600 border-slate-300 focus:ring-emerald-500 focus:ring-offset-0 transition">
                    <label for="remember_me" class="ml-2 text-sm text-slate-500 font-medium select-none cursor-pointer">Ingat saya di perangkat ini</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-4 rounded-2xl shadow-lg shadow-emerald-600/15 hover:shadow-xl transition duration-200 flex items-center justify-center space-x-2">
                    <span>Masuk</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>

            <div class="text-center text-sm text-slate-500 border-t border-slate-100 pt-5">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-bold text-emerald-600 hover:text-emerald-700 transition">
                    Daftar di sini
                </a>
            </div>
        </div>
    </div>
</body>
</html>
