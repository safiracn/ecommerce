<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalTransactions = Transaction::count();
        $totalRevenue = Transaction::sum('grand_total');

        // Low stock products (stock <= 10)
        $lowStockProducts = Product::with('category')
            ->lowStock()
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        // Best selling products
        $bestSellingProducts = TransactionDetail::select('product_id', 'product_name', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(subtotal) as total_revenue'))
            ->groupBy('product_id', 'product_name')
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();

        // Monthly sales for the current year
        $currentYear = now()->year;
        $monthlySalesRaw = Transaction::select(
            DB::raw('MONTH(transaction_date) as month'),
            DB::raw('SUM(grand_total) as total')
        )
            ->whereYear('transaction_date', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        // Fill all months (1-12) with 0 if no sales
        $monthlySales = [];
        $months = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
            7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];

        foreach ($months as $num => $name) {
            $monthlySales[] = [
                'label' => $name,
                'total' => $monthlySalesRaw[$num] ?? 0
            ];
        }

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalTransactions',
            'totalRevenue',
            'lowStockProducts',
            'bestSellingProducts',
            'monthlySales'
        ));
    }
}
