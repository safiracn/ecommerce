<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('admin');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('invoice_number', 'like', "%{$search}%")
                  ->orWhere('notes', 'like', "%{$search}%");
        }

        if ($request->filled('date')) {
            $query->whereDate('transaction_date', $request->date);
        }

        $transactions = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.transactions.index', compact('transactions'));
    }

    public function create()
    {
        // Fetch active products with category
        $products = Product::with('category')->active()->where('stock', '>', 0)->get();
        return view('admin.transactions.create', compact('products'));
    }

    public function store(TransactionRequest $request)
    {
        $validated = $request->validated();
        
        try {
            $transaction = DB::transaction(function () use ($validated, $request) {
                $subtotal = 0;
                $detailsData = [];
                
                // Process each item to calculate subtotal and check stock
                foreach ($validated['items'] as $item) {
                    $product = Product::findOrFail($item['product_id']);
                    
                    if ($product->stock < $item['quantity']) {
                        throw ValidationException::withMessages([
                            'items' => "Stok produk '{$product->name}' tidak mencukupi (Tersedia: {$product->stock}, Diminta: {$item['quantity']})."
                        ]);
                    }
                    
                    $itemSubtotal = $product->price * $item['quantity'];
                    $subtotal += $itemSubtotal;
                    
                    $detailsData[] = [
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'price' => $product->price,
                        'quantity' => $item['quantity'],
                        'subtotal' => $itemSubtotal,
                        'product_model' => $product // pass model to reduce stock later
                    ];
                }
                
                $discount = $validated['discount'] ?? 0;
                $tax = $validated['tax'] ?? 0;
                $grandTotal = $subtotal - $discount + $tax;
                if ($grandTotal < 0) {
                    $grandTotal = 0;
                }

                // Generate Invoice Number
                $invoiceNumber = Transaction::generateInvoiceNumber();

                // Create main transaction record
                $transaction = Transaction::create([
                    'invoice_number' => $invoiceNumber,
                    'transaction_date' => $validated['transaction_date'],
                    'subtotal' => $subtotal,
                    'discount' => $discount,
                    'tax' => $tax,
                    'grand_total' => $grandTotal,
                    'notes' => $validated['notes'] ?? null,
                    'admin_id' => Auth::id(),
                ]);

                // Create detail records and reduce stocks
                foreach ($detailsData as $detail) {
                    TransactionDetail::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $detail['product_id'],
                        'product_name' => $detail['product_name'],
                        'price' => $detail['price'],
                        'quantity' => $detail['quantity'],
                        'subtotal' => $detail['subtotal'],
                    ]);

                    // Reduce stock
                    $productModel = $detail['product_model'];
                    $productModel->decrement('stock', $detail['quantity']);
                }

                return $transaction;
            });

            return redirect()->route('admin.transactions.show', $transaction)
                ->with('success', 'Transaksi berhasil disimpan.');

        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem saat memproses transaksi: ' . $e->getMessage());
        }
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['admin', 'details.product']);
        return view('admin.transactions.show', compact('transaction'));
    }
}
