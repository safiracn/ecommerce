@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('breadcrumbs')
<nav class="flex text-sm text-slate-500 font-medium">
    <span>Admin</span>
    <span class="mx-2 text-slate-400">/</span>
    <span class="text-emerald-600">Dashboard</span>
</nav>
@endsection

@section('content')
<!-- Statistics Cards Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Produk -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition duration-200 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-slate-400 uppercase tracking-wider mb-1">Total Produk</p>
            <h3 class="text-3xl font-bold text-slate-800">{{ number_format($totalProducts, 0, ',', '.') }}</h3>
        </div>
        <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
        </div>
    </div>

    <!-- Total Kategori -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition duration-200 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-slate-400 uppercase tracking-wider mb-1">Total Kategori</p>
            <h3 class="text-3xl font-bold text-slate-800">{{ number_format($totalCategories, 0, ',', '.') }}</h3>
        </div>
        <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
        </div>
    </div>

    <!-- Total Transaksi -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition duration-200 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-slate-400 uppercase tracking-wider mb-1">Total Transaksi</p>
            <h3 class="text-3xl font-bold text-slate-800">{{ number_format($totalTransactions, 0, ',', '.') }}</h3>
        </div>
        <div class="p-3 bg-amber-50 rounded-xl text-amber-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
            </svg>
        </div>
    </div>

    <!-- Total Pendapatan -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition duration-200 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-slate-400 uppercase tracking-wider mb-1">Total Pendapatan</p>
            <h3 class="text-2xl md:text-3xl font-bold text-slate-800">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</h3>
        </div>
        <div class="p-3 bg-rose-50 rounded-xl text-rose-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>
</div>

<!-- Main Dashboard Split Content -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    <!-- Chart Column (2/3 width on desktop) -->
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
        <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center">
            <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
            Grafik Penjualan Bulanan ({{ now()->year }})
        </h3>
        <div class="relative h-[320px]">
            <canvas id="monthlySalesChart"></canvas>
        </div>
    </div>

    <!-- Low Stock warning (1/3 width on desktop) -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col">
        <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center text-red-600">
            <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            Produk Hampir Habis
        </h3>
        <div class="flex-1 overflow-y-auto">
            @if ($lowStockProducts->isEmpty())
                <div class="flex flex-col items-center justify-center h-full py-8 text-slate-400">
                    <svg class="w-12 h-12 mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm font-medium">Semua stok produk aman</p>
                </div>
            @else
                <div class="divide-y divide-slate-100">
                    @foreach ($lowStockProducts as $product)
                        <div class="py-3 flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 leading-tight">{{ $product->name }}</h4>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $product->category->name }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 ring-1 ring-red-600/10">
                                Stok: {{ $product->stock }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Bottom Row: Best Selling Products -->
<div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
    <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center">
        <svg class="w-5 h-5 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
        </svg>
        Produk Terlaris
    </h3>
    @if ($bestSellingProducts->isEmpty())
        <div class="flex flex-col items-center justify-center py-12 text-slate-400">
            <svg class="w-16 h-16 mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <p class="text-base font-semibold">Belum ada transaksi</p>
            <p class="text-sm text-slate-400 mt-1">Transaksi penjualan akan dihitung di sini.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        <th class="pb-3 pl-4">Nama Produk</th>
                        <th class="pb-3 text-right">Terjual</th>
                        <th class="pb-3 text-right pr-4">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @foreach ($bestSellingProducts as $item)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="py-4 pl-4 font-semibold text-slate-800">{{ $item->product_name }}</td>
                            <td class="py-4 text-right text-slate-600 font-medium">{{ number_format($item->total_sold, 0, ',', '.') }} unit</td>
                            <td class="py-4 text-right text-emerald-600 font-bold pr-4">Rp{{ number_format($item->total_revenue, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('monthlySalesChart').getContext('2d');
        const salesData = @json($monthlySales);
        
        const labels = salesData.map(item => item.label);
        const data = salesData.map(item => item.total);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: data,
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: 'rgba(16, 185, 129, 1)',
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        padding: 12,
                        backgroundColor: '#0f172a',
                        titleFont: {
                            family: 'Outfit',
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            family: 'Outfit',
                            size: 13
                        },
                        callbacks: {
                            label: function (context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(241, 245, 249, 1)'
                        },
                        ticks: {
                            font: {
                                family: 'Outfit',
                                size: 11
                            },
                            callback: function(value, index, values) {
                                return 'Rp' + new Intl.NumberFormat('id-ID', { notation: 'compact' }).format(value);
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: 'Outfit',
                                size: 11
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
