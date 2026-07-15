<!-- Sidebar container -->
<aside class="w-64 bg-emerald-950 text-white flex-shrink-0 hidden md:flex flex-col border-r border-emerald-900/40">
    <!-- Brand -->
    <div class="h-16 flex items-center justify-between px-6 border-b border-emerald-900/60 bg-emerald-950/80">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2.5">
            <div class="p-1.5 bg-emerald-500 rounded-lg text-emerald-950 shadow-md">
                <!-- Shop icon -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <span class="font-bold text-lg tracking-wide uppercase text-emerald-50">LukmanMart</span>
        </a>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-500 text-emerald-950 shadow-md font-semibold' : 'text-emerald-300 hover:bg-emerald-900/60 hover:text-emerald-50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
            </svg>
            Dashboard
        </a>

        <!-- Kategori -->
        <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-emerald-500 text-emerald-950 shadow-md font-semibold' : 'text-emerald-300 hover:bg-emerald-900/60 hover:text-emerald-50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            Kategori
        </a>

        <!-- Produk -->
        <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.products.*') ? 'bg-emerald-500 text-emerald-950 shadow-md font-semibold' : 'text-emerald-300 hover:bg-emerald-900/60 hover:text-emerald-50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            Produk
        </a>

        <!-- Transaksi -->
        <a href="{{ route('admin.transactions.create') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.transactions.create') ? 'bg-emerald-500 text-emerald-950 shadow-md font-semibold' : 'text-emerald-300 hover:bg-emerald-900/60 hover:text-emerald-50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
            Kasir Baru
        </a>
        <a href="{{ route('admin.transactions.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.transactions.index') || request()->routeIs('admin.transactions.show') ? 'bg-emerald-500 text-emerald-950 shadow-md font-semibold' : 'text-emerald-300 hover:bg-emerald-900/60 hover:text-emerald-50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
            </svg>
            Riwayat Transaksi
        </a>

        <!-- Laporan -->
        <a href="{{ route('admin.reports.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.reports.*') ? 'bg-emerald-500 text-emerald-950 shadow-md font-semibold' : 'text-emerald-300 hover:bg-emerald-900/60 hover:text-emerald-50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            Laporan
        </a>

        <!-- Profil -->
        <a href="{{ route('admin.profile.edit') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.profile.*') ? 'bg-emerald-500 text-emerald-950 shadow-md font-semibold' : 'text-emerald-300 hover:bg-emerald-900/60 hover:text-emerald-50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Profil Admin
        </a>
    </nav>

    <!-- Logout Area -->
    <div class="p-4 border-t border-emerald-900/60 bg-emerald-950/40">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center px-4 py-3 text-sm font-medium text-red-300 rounded-xl hover:bg-red-900/20 hover:text-red-100 transition-all duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Keluar
            </button>
        </form>
    </div>
</aside>
