<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->take(8)->get();
        $featuredProducts = Product::with('category')
            ->active()
            ->latest()
            ->take(8)
            ->get();

        // Best selling products
        $bestSellers = Product::with('category')
            ->active()
            ->leftJoin('transaction_details', 'products.id', '=', 'transaction_details.product_id')
            ->select('products.*')
            ->selectRaw('COALESCE(SUM(transaction_details.quantity), 0) as total_sold')
            ->groupBy('products.id')
            ->orderBy('total_sold', 'desc')
            ->take(8)
            ->get();

        return view('home', compact('categories', 'featuredProducts', 'bestSellers'));
    }

    public function products(Request $request)
    {
        $categories = Category::all();
        
        $query = Product::with('category')->active();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $products = $query->latest()->paginate(10)->withQueryString();

        return view('products', compact('categories', 'products'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
