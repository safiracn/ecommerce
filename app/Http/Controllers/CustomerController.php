<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    public function profile()
    {
        $customer = Auth::user();
        return view('customer.profile', compact('customer'));
    }

    public function updateProfile(Request $request)
    {
        $customer = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email,' . $customer->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
            'avatar.image' => 'File harus berupa gambar.',
            'avatar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('avatar')) {
            if ($customer->avatar) {
                Storage::disk('public')->delete($customer->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $customer->update($validated);

        return redirect()->route('customer.profile')->with('success', 'Profil Anda berhasil diperbarui.');
    }

    public function orders()
    {
        $orders = Transaction::with(['details.product'])
            ->where('admin_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('customer.orders', compact('orders'));
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $validated = $request->validate([
            'notes' => ['nullable', 'string'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
        ], [
            'phone.required' => 'Nomor telepon wajib diisi untuk pengiriman.',
            'address.required' => 'Alamat pengiriman wajib diisi.',
        ]);

        try {
            $transaction = DB::transaction(function () use ($cart, $validated) {
                $subtotal = 0;
                $detailsData = [];

                // Check stock and calculate subtotal
                foreach ($cart as $item) {
                    $product = Product::findOrFail($item['id']);

                    if ($product->stock < $item['quantity']) {
                        throw ValidationException::withMessages([
                            'cart' => "Stok produk '{$product->name}' tidak mencukupi (Tersedia: {$product->stock}, Diminta: {$item['quantity']})."
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
                        'product_model' => $product
                    ];
                }

                // Simple pricing rules
                $discount = $subtotal > 150000 ? 15000 : 0;
                $tax = $subtotal * 0.1;
                $grandTotal = $subtotal - $discount + $tax;

                if ($grandTotal < 0) {
                    $grandTotal = 0;
                }

                // Generate Invoice Number
                $invoiceNumber = Transaction::generateInvoiceNumber();

                // Create main transaction
                $transaction = Transaction::create([
                    'invoice_number' => $invoiceNumber,
                    'transaction_date' => now()->format('Y-m-d'),
                    'subtotal' => $subtotal,
                    'discount' => $discount,
                    'tax' => $tax,
                    'grand_total' => $grandTotal,
                    'notes' => "Pengiriman ke: " . $validated['address'] . " (Telp: " . $validated['phone'] . "). Catatan: " . ($validated['notes'] ?? '-'),
                    'admin_id' => Auth::id(), // maps directly to customer id in admins table
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

                    $productModel = $detail['product_model'];
                    $productModel->decrement('stock', $detail['quantity']);
                }

                return $transaction;
            });

            // Clear session cart
            session()->forget('cart');

            return redirect()->route('customer.orders')->with('success', 'Checkout berhasil! Pesanan Anda sedang diproses.');

        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem saat checkout: ' . $e->getMessage());
        }
    }
}
