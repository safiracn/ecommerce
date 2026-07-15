<header class="h-16 bg-white border-b border-slate-200/80 flex items-center justify-between px-6 sticky top-0 z-30">
    <!-- Mobile Sidebar Toggle -->
    <div class="flex items-center space-x-4 md:space-x-0">
        <button @click="sidebarOpen = !sidebarOpen" class="text-slate-500 hover:text-slate-700 focus:outline-none md:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <span class="text-sm font-medium text-slate-500 hidden sm:inline-block">
            Selamat datang, <strong class="text-slate-800">{{ Auth::user()->name }}</strong> (Admin)
        </span>
    </div>

    <!-- Right Topbar Controls -->
    <div class="flex items-center space-x-4">
        <!-- Date Display -->
        <div class="text-sm text-slate-500 hidden lg:flex items-center space-x-1">
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span>{{ now()->isoFormat('dddd, D MMMM YYYY') }}</span>
        </div>

        <div class="h-8 w-px bg-slate-200"></div>

        <!-- User Profile Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" @click.away="open = false" class="flex items-center space-x-2.5 focus:outline-none group">
                <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 font-bold flex items-center justify-center text-sm shadow-sm ring-2 ring-emerald-500/20 transition group-hover:ring-emerald-500/40">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="hidden sm:block text-left">
                    <p class="text-sm font-semibold text-slate-700 group-hover:text-slate-900 transition leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-400 mt-0.5 leading-none">{{ Auth::user()->email }}</p>
                </div>
                <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-slate-100 py-1.5 z-40 focus:outline-none" 
                 style="display: none;">
                
                <a href="{{ route('admin.profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">
                    <svg class="w-4 h-4 mr-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Ubah Profil
                </a>
                
                <div class="border-t border-slate-100 my-1"></div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition text-left">
                        <svg class="w-4 h-4 mr-2.5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Sidebar Drawer (Overlay) -->
<div x-show="sidebarOpen" class="fixed inset-0 z-50 flex md:hidden" style="display: none;">
    <!-- Overlay -->
    <div @click="sidebarOpen = false" 
         x-show="sidebarOpen"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

    <!-- Drawer Content -->
    <div x-show="sidebarOpen"
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         class="relative flex-1 flex flex-col max-w-xs w-full bg-emerald-950 text-white">
         
        <!-- Close Button -->
        <div class="absolute top-0 right-0 -mr-12 pt-4">
            <button @click="sidebarOpen = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l18 18" />
                </svg>
            </button>
        </div>

        <div class="h-16 flex items-center justify-between px-6 border-b border-emerald-900/60 bg-emerald-950/80">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2.5">
                <div class="p-1.5 bg-emerald-500 rounded-lg text-emerald-950 shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <span class="font-bold text-lg tracking-wide uppercase text-emerald-50">LukmanMart</span>
            </a>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-500 text-emerald-950 shadow font-semibold' : 'text-emerald-300 hover:bg-emerald-900/60 hover:text-emerald-50' }}">
                Dashboard
            </a>
            <!-- Kategori -->
            <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.categories.*') ? 'bg-emerald-500 text-emerald-950 shadow font-semibold' : 'text-emerald-300 hover:bg-emerald-900/60 hover:text-emerald-50' }}">
                Kategori
            </a>
            <!-- Produk -->
            <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.products.*') ? 'bg-emerald-500 text-emerald-950 shadow font-semibold' : 'text-emerald-300 hover:bg-emerald-900/60 hover:text-emerald-50' }}">
                Produk
            </a>
            <!-- Transaksi -->
            <a href="{{ route('admin.transactions.create') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.transactions.create') ? 'bg-emerald-500 text-emerald-950 shadow font-semibold' : 'text-emerald-300 hover:bg-emerald-900/60 hover:text-emerald-50' }}">
                Kasir Baru
            </a>
            <a href="{{ route('admin.transactions.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.transactions.index') || request()->routeIs('admin.transactions.show') ? 'bg-emerald-500 text-emerald-950 shadow font-semibold' : 'text-emerald-300 hover:bg-emerald-900/60 hover:text-emerald-50' }}">
                Riwayat Transaksi
            </a>
            <!-- Laporan -->
            <a href="{{ route('admin.reports.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.reports.*') ? 'bg-emerald-500 text-emerald-950 shadow font-semibold' : 'text-emerald-300 hover:bg-emerald-900/60 hover:text-emerald-50' }}">
                Laporan
            </a>
            <!-- Profil -->
            <a href="{{ route('admin.profile.edit') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.profile.*') ? 'bg-emerald-500 text-emerald-950 shadow font-semibold' : 'text-emerald-300 hover:bg-emerald-900/60 hover:text-emerald-50' }}">
                Profil Admin
            </a>
        </nav>

        <div class="p-4 border-t border-emerald-900/60 bg-emerald-950/40">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 text-sm font-medium text-red-300 rounded-xl hover:bg-red-900/20 hover:text-red-100 transition">
                    Keluar
                </button>
            </form>
        </div>
    </div>
</div>
