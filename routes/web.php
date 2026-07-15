<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [HomeController::class, 'products'])->name('public.products');
Route::get('/about', [HomeController::class, 'about'])->name('public.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('public.contact');

// Public Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

// Customer Routes (Protected by Auth)
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/profile', [CustomerController::class, 'profile'])->name('profile');
    Route::patch('/profile', [CustomerController::class, 'updateProfile'])->name('profile.update');
    Route::get('/orders', [CustomerController::class, 'orders'])->name('orders');
    Route::post('/checkout', [CustomerController::class, 'checkout'])->name('checkout');
});

// Admin Routes (Protected by Auth & Admin Only)
Route::middleware(['auth', 'admin.only'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Category CRUD
    Route::resource('categories', CategoryController::class);
    
    // Product CRUD
    Route::resource('products', ProductController::class);
    
    // Transaction
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    
    // Reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/export-pdf', [ReportController::class, 'exportPdf'])->name('reports.export-pdf');
    Route::get('reports/export-excel', [ReportController::class, 'exportExcel'])->name('reports.export-excel');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
