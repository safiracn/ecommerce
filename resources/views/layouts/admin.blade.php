<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - LukmanMart Admin</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
        }
        [x-cloak] { display: none !important; }
    </style>
    @yield('styles')
</head>
<body class="overflow-x-hidden">
    <div class="flex h-screen bg-slate-50 overflow-hidden" x-data="{ sidebarOpen: false }">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <!-- Content Area -->
        <div class="flex-1 flex flex-col overflow-y-auto overflow-x-hidden">
            <!-- Topbar -->
            @include('layouts.partials.topbar')

            <!-- Main Content -->
            <main class="flex-1 p-6 md:p-8">
                <!-- Breadcrumbs & Heading -->
                <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between space-y-2 md:space-y-0">
                    <div>
                        @yield('breadcrumbs')
                        <h1 class="text-2xl md:text-3xl font-bold text-slate-800 tracking-tight mt-1">@yield('page-title')</h1>
                    </div>
                    <div>
                        @yield('actions')
                    </div>
                </div>

                <!-- Toast Notifications using SweetAlert2/Browser Flash -->
                @if (session('success'))
                    <script>
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: "{{ session('success') }}",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    </script>
                @endif

                @if (session('error'))
                    <script>
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: "{{ session('error') }}",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    </script>
                @endif

                <!-- Actual Content -->
                @yield('content')
            </main>
        </div>
    </div>

    @yield('scripts')
    <script>
        // Common confirmation alert for delete buttons
        document.addEventListener('click', function(e) {
            const deleteBtn = e.target.closest('.btn-delete-confirm');
            if (deleteBtn) {
                e.preventDefault();
                const form = deleteBtn.closest('form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#16A34A',
                    cancelButtonColor: '#EF4444',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'rounded-xl px-4 py-2 font-medium',
                        cancelButton: 'rounded-xl px-4 py-2 font-medium'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    </script>
</body>
</html>
