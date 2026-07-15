<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'transaction_date' => 'required|date',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'transaction_date.required' => 'Tanggal transaksi wajib diisi.',
            'transaction_date.date' => 'Format tanggal transaksi tidak valid.',
            'discount.numeric' => 'Diskon harus berupa angka.',
            'discount.min' => 'Diskon tidak boleh kurang dari 0.',
            'tax.numeric' => 'Pajak harus berupa angka.',
            'tax.min' => 'Pajak tidak boleh kurang dari 0.',
            'items.required' => 'Daftar produk belanja wajib diisi.',
            'items.array' => 'Daftar produk belanja tidak valid.',
            'items.min' => 'Wajib memilih minimal 1 produk.',
            'items.*.product_id.required' => 'ID produk wajib diisi.',
            'items.*.product_id.exists' => 'Produk tidak ditemukan di database.',
            'items.*.quantity.required' => 'Kuantitas wajib diisi.',
            'items.*.quantity.integer' => 'Kuantitas harus berupa angka bulat.',
            'items.*.quantity.min' => 'Kuantitas minimal 1 unit.',
        ];
    }
}
