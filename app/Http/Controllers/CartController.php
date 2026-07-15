<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Apply a simple 10% tax
        $tax = $subtotal * 0.1;
        // Simple free delivery promo / discount if above Rp 150.000
        $discount = $subtotal > 150000 ? 15000 : 0;
        $grandTotal = $subtotal - $discount + $tax;

        return view('cart', compact('cart', 'subtotal', 'tax', 'discount', 'grandTotal'));
    }

    public function add(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);

        if (!$product->is_active || $product->stock < $quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi atau produk tidak aktif.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $newQty = $cart[$product->id]['quantity'] + $quantity;
            if ($product->stock < $newQty) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi untuk jumlah yang diminta.');
            }
            $cart[$product->id]['quantity'] = $newQty;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image_url,
                'stock' => $product->stock
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, Product $product)
    {
        $quantity = $request->input('quantity');

        if ($quantity <= 0) {
            return $this->remove($product);
        }

        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui.');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }
}
