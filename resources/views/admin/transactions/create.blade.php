@extends('layouts.admin')

@section('title', 'Kasir Baru')
@section('page-title', 'Kasir (POS)')

@section('styles')
<style>
    /* Custom scrollbar for POS product list */
    .pos-product-scroll::-webkit-scrollbar {
        width: 6px;
    }
    .pos-product-scroll::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    .pos-product-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    .pos-product-scroll::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endsection

@section('breadcrumbs')
<nav class="flex text-sm text-slate-500 font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition">Dashboard</a>
    <span class="mx-2 text-slate-400">/</span>
    <span class="text-emerald-600">Kasir</span>
</nav>
@endsection

@section('content')
<!-- POS Interface split -->
<div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">
    <!-- Left Column: Products Choice (7 cols) -->
    <div class="xl:col-span-7 space-y-6">
        <!-- Search & Filter Area -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
            <div class="flex flex-col sm:flex-row gap-3">
                <!-- Search bar -->
                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" 
                           id="posSearchInput"
                           class="pl-11 pr-4 block w-full rounded-xl border border-slate-200 bg-slate-50/50 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition duration-200" 
                           placeholder="Cari nama atau SKU produk...">
                </div>

                <!-- Category selector -->
                <div class="w-full sm:w-48">
                    <select id="posCategorySelect"
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 py-2.5 px-3.5 text-sm text-slate-700 focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition duration-200">
                        <option value="">Semua Kategori</option>
                        @foreach ($products->pluck('category')->unique('id') as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Products Grid Container -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
            <h3 class="font-bold text-slate-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                Pilih Produk
            </h3>

            <!-- Scrollable product listing -->
            <div class="pos-product-scroll max-h-[580px] overflow-y-auto pr-2">
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4" id="posProductsGrid">
                    @foreach ($products as $prod)
                        <div class="pos-product-card bg-slate-50 hover:bg-slate-100/60 rounded-xl border border-slate-200/60 p-4 transition duration-200 flex flex-col justify-between" 
                             data-id="{{ $prod->id }}" 
                             data-name="{{ $prod->name }}" 
                             data-sku="{{ $prod->sku }}" 
                             data-price="{{ $prod->price }}" 
                             data-stock="{{ $prod->stock }}" 
                             data-category-id="{{ $prod->category_id }}">
                             
                            <!-- Product top detail -->
                            <div class="space-y-2">
                                <div class="w-full aspect-video bg-white rounded-lg border border-slate-100 overflow-hidden flex items-center justify-center">
                                    @if ($prod->image)
                                        <img src="{{ asset('storage/' . $prod->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">{{ $prod->sku }}</span>
                                    <h4 class="text-sm font-bold text-slate-800 leading-tight line-clamp-2 h-10 mt-0.5">{{ $prod->name }}</h4>
                                </div>
                            </div>

                            <!-- Product action row -->
                            <div class="mt-4 flex items-center justify-between border-t border-slate-200/40 pt-3">
                                <div>
                                    <span class="text-xs text-slate-400 block font-semibold">Harga</span>
                                    <span class="text-sm font-bold text-emerald-600">Rp{{ number_format($prod->price, 0, ',', '.') }}</span>
                                </div>
                                <button type="button" 
                                        class="pos-btn-add-to-cart p-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg shadow transition duration-150 focus:outline-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Empty State inside product choice -->
                <div id="posNoProductsState" class="hidden py-12 text-center text-slate-400">
                    <svg class="w-12 h-12 mx-auto mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm font-medium">Produk tidak cocok dengan pencarian Anda.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Cart Receipt (5 cols) -->
    <div class="xl:col-span-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col justify-between h-[850px] sticky top-24">
        <!-- Card Header -->
        <div class="p-5 border-b border-slate-100 bg-slate-50/50">
            <h3 class="font-bold text-slate-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                Detail Keranjang Belanja
            </h3>
        </div>

        <!-- POS Checkout Form -->
        <form action="{{ route('admin.transactions.store') }}" method="POST" id="posSubmitForm" class="flex-1 flex flex-col justify-between">
            @csrf

            <!-- Hidden elements container for cart entries -->
            <div id="hiddenCartInputs"></div>

            <!-- Scrollable list of items -->
            <div class="flex-1 overflow-y-auto p-5 pos-product-scroll border-b border-slate-100">
                <!-- Date input -->
                <div class="mb-5">
                    <label for="transaction_date" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Tanggal Transaksi</label>
                    <input type="date" 
                           name="transaction_date" 
                           id="transaction_date" 
                           value="{{ date('Y-m-d') }}"
                           required
                           class="block w-full rounded-xl border border-slate-200 bg-slate-50/30 py-2 px-3 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition duration-200">
                </div>

                <!-- Product list -->
                <div class="space-y-4" id="posCartList">
                    <!-- Dynamic Cart Row Inserted Here -->
                </div>

                <!-- Empty State inside cart -->
                <div id="posCartEmptyState" class="flex flex-col items-center justify-center h-48 text-slate-400 py-8">
                    <svg class="w-12 h-12 mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <p class="text-sm font-semibold">Keranjang masih kosong</p>
                    <p class="text-xs text-center mt-1">Pilih produk di sebelah kiri untuk ditambahkan.</p>
                </div>
            </div>

            <!-- Totals & Extra Calculations -->
            <div class="bg-slate-50/70 p-5 space-y-4 border-b border-slate-100">
                <!-- Discount & Tax inputs -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Discount input -->
                    <div>
                        <label for="posDiscount" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Diskon (Rp)</label>
                        <input type="number" 
                               name="discount" 
                               id="posDiscount" 
                               value="0"
                               min="0"
                               class="block w-full rounded-xl border border-slate-200 bg-white py-1.5 px-3 text-sm text-slate-800 focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition">
                    </div>

                    <!-- Tax input -->
                    <div>
                        <label for="posTax" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Pajak (Rp)</label>
                        <input type="number" 
                               name="tax" 
                               id="posTax" 
                               value="0"
                               min="0"
                               class="block w-full rounded-xl border border-slate-200 bg-white py-1.5 px-3 text-sm text-slate-800 focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition">
                    </div>
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Catatan Transaksi</label>
                    <textarea name="notes" 
                              id="notes" 
                              rows="2" 
                              class="block w-full rounded-xl border border-slate-200 bg-white py-1.5 px-3 text-sm text-slate-800 placeholder-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition" 
                              placeholder="Masukkan catatan (opsional)..."></textarea>
                </div>
            </div>

            <!-- Receipt Breakdown -->
            <div class="p-5 space-y-3 bg-slate-100/50">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-slate-500 font-medium">Subtotal</span>
                    <span class="text-slate-800 font-semibold" id="labelSubtotal">Rp0</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-slate-500 font-medium">Diskon</span>
                    <span class="text-red-600 font-semibold" id="labelDiscount">-Rp0</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-slate-500 font-medium">Pajak</span>
                    <span class="text-slate-800 font-semibold" id="labelTax">Rp0</span>
                </div>
                
                <div class="border-t border-slate-200 my-2"></div>
                
                <div class="flex items-center justify-between">
                    <span class="text-base font-bold text-slate-700">Grand Total</span>
                    <span class="text-2xl font-bold text-emerald-600" id="labelGrandTotal">Rp0</span>
                </div>

                <!-- Validation alert for error -->
                @error('items')
                    <div class="p-3 bg-red-50 border border-red-200 text-xs font-bold text-red-600 rounded-xl mt-3 flex items-center">
                        <svg class="w-4 h-4 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </div>
                @enderror

                <!-- Checkout Button -->
                <button type="submit" 
                        id="posCheckoutSubmitBtn"
                        disabled
                        class="w-full bg-slate-300 text-slate-500 cursor-not-allowed font-bold py-3.5 px-4 rounded-xl shadow-lg transition duration-200 mt-4 flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Simpan Transaksi</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // POS Application state
        let cart = [];

        // Elements
        const searchInput = document.getElementById('posSearchInput');
        const categorySelect = document.getElementById('posCategorySelect');
        const productsGrid = document.getElementById('posProductsGrid');
        const noProductsState = document.getElementById('posNoProductsState');
        
        const cartList = document.getElementById('posCartList');
        const cartEmptyState = document.getElementById('posCartEmptyState');
        const hiddenInputsContainer = document.getElementById('hiddenCartInputs');
        const checkoutForm = document.getElementById('posSubmitForm');
        const checkoutSubmitBtn = document.getElementById('posCheckoutSubmitBtn');
        
        const discountInput = document.getElementById('posDiscount');
        const taxInput = document.getElementById('posTax');
        
        const labelSubtotal = document.getElementById('labelSubtotal');
        const labelDiscount = document.getElementById('labelDiscount');
        const labelTax = document.getElementById('labelTax');
        const labelGrandTotal = document.getElementById('labelGrandTotal');

        // Format money helper
        function formatRupiah(value) {
            return 'Rp' + new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0 }).format(value);
        }

        // Filter products function
        function filterProducts() {
            const searchValue = searchInput.value.toLowerCase().trim();
            const categoryValue = categorySelect.value;
            let visibleCount = 0;

            const cards = productsGrid.querySelectorAll('.pos-product-card');
            cards.forEach(card => {
                const name = card.dataset.name.toLowerCase();
                const sku = card.dataset.sku.toLowerCase();
                const categoryId = card.dataset.categoryId;

                const matchSearch = name.includes(searchValue) || sku.includes(searchValue);
                const matchCategory = !categoryValue || categoryId === categoryValue;

                if (matchSearch && matchCategory) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (visibleCount === 0) {
                noProductsState.classList.remove('hidden');
            } else {
                noProductsState.classList.add('hidden');
            }
        }

        // Event listeners for product filter
        searchInput.addEventListener('input', filterProducts);
        categorySelect.addEventListener('change', filterProducts);

        // Add to cart click event
        productsGrid.addEventListener('click', function (e) {
            const addBtn = e.target.closest('.pos-btn-add-to-cart');
            if (!addBtn) return;

            const card = addBtn.closest('.pos-product-card');
            const id = parseInt(card.dataset.id);
            const name = card.dataset.name;
            const price = parseFloat(card.dataset.price);
            const maxStock = parseInt(card.dataset.stock);

            addToCart(id, name, price, maxStock);
        });

        // Add to cart logic
        function addToCart(id, name, price, maxStock) {
            const existingIndex = cart.findIndex(item => item.id === id);

            if (existingIndex > -1) {
                if (cart[existingIndex].quantity < maxStock) {
                    cart[existingIndex].quantity++;
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Stok Terbatas',
                        text: `Stok maksimal produk ${name} hanya ${maxStock} unit.`,
                        confirmButtonColor: '#16A34A'
                    });
                }
            } else {
                cart.push({
                    id: id,
                    name: name,
                    price: price,
                    quantity: 1,
                    maxStock: maxStock
                });
            }

            renderCart();
        }

        // Update quantity in cart
        function updateQuantity(id, newQty) {
            const index = cart.findIndex(item => item.id === id);
            if (index === -1) return;

            newQty = parseInt(newQty);
            if (isNaN(newQty) || newQty < 1) {
                newQty = 1;
            }

            const maxStock = cart[index].maxStock;
            if (newQty > maxStock) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Stok Terbatas',
                    text: `Stok maksimal produk ${cart[index].name} hanya ${maxStock} unit.`,
                    confirmButtonColor: '#16A34A'
                });
                newQty = maxStock;
            }

            cart[index].quantity = newQty;
            renderCart();
        }

        // Remove item from cart
        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            renderCart();
        }

        // Render Cart list and totals
        function renderCart() {
            cartList.innerHTML = '';
            hiddenInputsContainer.innerHTML = '';

            if (cart.length === 0) {
                cartEmptyState.classList.remove('hidden');
                checkoutSubmitBtn.disabled = true;
                checkoutSubmitBtn.classList.remove('bg-emerald-600', 'hover:bg-emerald-700', 'text-white', 'cursor-pointer');
                checkoutSubmitBtn.classList.add('bg-slate-300', 'text-slate-500', 'cursor-not-allowed');
                
                labelSubtotal.textContent = 'Rp0';
                labelGrandTotal.textContent = 'Rp0';
                return;
            }

            cartEmptyState.classList.add('hidden');
            checkoutSubmitBtn.disabled = false;
            checkoutSubmitBtn.classList.remove('bg-slate-300', 'text-slate-500', 'cursor-not-allowed');
            checkoutSubmitBtn.classList.add('bg-emerald-600', 'hover:bg-emerald-700', 'text-white', 'cursor-pointer');

            let subtotal = 0;

            cart.forEach((item, index) => {
                const itemSubtotal = item.price * item.quantity;
                subtotal += itemSubtotal;

                // Render cart element
                const row = document.createElement('div');
                row.className = 'flex items-center justify-between p-3.5 bg-slate-50 hover:bg-slate-100/50 border border-slate-200/50 rounded-xl transition duration-150';
                row.innerHTML = `
                    <div class="flex-1 min-w-0 pr-3">
                        <h4 class="text-sm font-bold text-slate-800 truncate">${item.name}</h4>
                        <span class="text-xs text-slate-500 font-semibold">${formatRupiah(item.price)} / unit</span>
                    </div>
                    <div class="flex items-center space-x-3 flex-shrink-0">
                        <div class="flex items-center border border-slate-200 bg-white rounded-lg p-0.5 shadow-sm">
                            <button type="button" class="btn-qty-minus p-1 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-md transition" data-id="${item.id}">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </button>
                            <input type="number" 
                                   class="input-qty w-12 text-center text-sm font-bold text-slate-800 bg-transparent border-0 focus:ring-0 p-0 focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" 
                                   value="${item.quantity}"
                                   data-id="${item.id}">
                            <button type="button" class="btn-qty-plus p-1 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-md transition" data-id="${item.id}">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                        <div class="text-right w-20">
                            <span class="text-sm font-bold text-slate-800 block">${formatRupiah(itemSubtotal)}</span>
                        </div>
                        <button type="button" class="btn-cart-remove text-slate-300 hover:text-red-600 p-1 hover:bg-red-50 rounded-lg transition" data-id="${item.id}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                `;
                cartList.appendChild(row);

                // Add to hidden input arrays
                const inputProdId = document.createElement('input');
                inputProdId.type = 'hidden';
                inputProdId.name = `items[${index}][product_id]`;
                inputProdId.value = item.id;
                
                const inputQty = document.createElement('input');
                inputQty.type = 'hidden';
                inputQty.name = `items[${index}][quantity]`;
                inputQty.value = item.quantity;
                
                hiddenInputsContainer.appendChild(inputProdId);
                hiddenInputsContainer.appendChild(inputQty);
            });

            calculateReceipt(subtotal);
        }

        // Recalculate Receipt breakdown totals
        function calculateReceipt(subtotal) {
            const discount = parseFloat(discountInput.value) || 0;
            const tax = parseFloat(taxInput.value) || 0;
            
            let grandTotal = subtotal - discount + tax;
            if (grandTotal < 0) grandTotal = 0;

            labelSubtotal.textContent = formatRupiah(subtotal);
            labelDiscount.textContent = '- ' + formatRupiah(discount);
            labelTax.textContent = formatRupiah(tax);
            labelGrandTotal.textContent = formatRupiah(grandTotal);
        }

        // Cart item action event delegation
        cartList.addEventListener('click', function(e) {
            const removeBtn = e.target.closest('.btn-cart-remove');
            if (removeBtn) {
                removeFromCart(parseInt(removeBtn.dataset.id));
                return;
            }

            const minusBtn = e.target.closest('.btn-qty-minus');
            if (minusBtn) {
                const id = parseInt(minusBtn.dataset.id);
                const item = cart.find(i => i.id === id);
                if (item) {
                    if (item.quantity > 1) {
                        updateQuantity(id, item.quantity - 1);
                    } else {
                        removeFromCart(id);
                    }
                }
                return;
            }

            const plusBtn = e.target.closest('.btn-qty-plus');
            if (plusBtn) {
                const id = parseInt(plusBtn.dataset.id);
                const item = cart.find(i => i.id === id);
                if (item) {
                    updateQuantity(id, item.quantity + 1);
                }
                return;
            }
        });

        cartList.addEventListener('change', function(e) {
            const qtyInput = e.target.closest('.input-qty');
            if (qtyInput) {
                updateQuantity(parseInt(qtyInput.dataset.id), qtyInput.value);
            }
        });

        // Recalculate if discount or tax inputs change
        discountInput.addEventListener('input', function() {
            let val = parseFloat(this.value);
            if (isNaN(val) || val < 0) this.value = 0;
            const sub = cart.reduce((acc, curr) => acc + (curr.price * curr.quantity), 0);
            calculateReceipt(sub);
        });

        taxInput.addEventListener('input', function() {
            let val = parseFloat(this.value);
            if (isNaN(val) || val < 0) this.value = 0;
            const sub = cart.reduce((acc, curr) => acc + (curr.price * curr.quantity), 0);
            calculateReceipt(sub);
        });
    });
</script>
@endsection
