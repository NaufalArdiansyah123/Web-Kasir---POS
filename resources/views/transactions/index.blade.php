@extends('layouts.app')

@section('title', 'Transaksi')
@section('page-title', 'Transaksi Penjualan')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Daftar Produk -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center mb-6">
                <div class="bg-blue-600 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Pilih Produk</h3>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($products as $product)
                        <div class="border-2 border-gray-200 rounded-xl p-4 hover:border-blue-600 hover:shadow-lg cursor-pointer transition-all duration-200 hover:-translate-y-1"
                            onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, {{ $product->stock }})">
                            <h4 class="font-semibold text-gray-800 text-sm truncate">{{ $product->name }}</h4>
                            <p class="text-xs text-gray-500 mb-2">{{ $product->category->name }}</p>
                            <p class="text-blue-600 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-500 mt-1">Stok: {{ $product->stock }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="text-gray-500">Tidak ada produk dengan stok tersedia</p>
                </div>
            @endif
        </div>

        <!-- Keranjang -->
        <div class="bg-white rounded-2xl shadow-lg p-6 h-fit sticky top-6">
            <div class="flex items-center mb-6">
                <div class="bg-blue-600 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 3h2l.4 2H21l-.9 4.5H6.5l.5 2.5h11l-.9 4.5H5l1.1 5.5h12" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Keranjang</h3>
                    <p class="text-xs text-gray-500" id="cart-count">0 item</p>
                </div>
            </div>

            <div id="cart-items"
                class="space-y-2 mb-4 max-h-64 overflow-y-auto border border-gray-100 rounded-lg p-3 bg-gray-50">
                <p class="text-sm text-gray-500 text-center py-8">Belum ada produk</p>
            </div>

            <div class="border-t-2 border-gray-200 pt-4 space-y-3">
                <!-- Summary -->
                <div class="bg-gray-50 rounded-lg p-3 space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Subtotal:</span>
                        <span id="subtotal" class="font-semibold text-gray-900">Rp 0</span>
                    </div>
                </div>

                <!-- Total -->
                <div class="bg-blue-50 rounded-lg p-3 border border-blue-200">
                    <div class="flex justify-between">
                        <span class="font-bold text-gray-900">TOTAL:</span>
                        <span class="font-bold text-lg text-blue-600" id="total">Rp 0</span>
                    </div>
                </div>

                <!-- Payment Input -->
                <div>
                    <label for="bayar" class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Bayar</label>
                    <input type="number" id="bayar" min="0" placeholder="Masukkan jumlah pembayaran"
                        class="w-full px-4 py-2.5 border-2 border-gray-300 rounded-lg focus:border-blue-600 focus:ring-0 text-lg font-semibold"
                        oninput="hitungKembalian()">
                </div>

                <!-- Change Display -->
                <div class="bg-green-50 rounded-lg p-3 border border-green-200">
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Kembalian</label>
                    <div class="text-3xl font-bold text-green-600" id="kembalian">Rp 0</div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-2 pt-2">
                    <button type="button" onclick="prosesTransaksi()"
                        class="w-full px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 hover:shadow-lg transition-all duration-300 font-semibold flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Proses Transaksi
                    </button>

                    <button type="button" onclick="resetCart()"
                        class="w-full px-6 py-2.5 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-all duration-300 font-medium">
                        Reset Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let cart = [];
            let totalHarga = 0;

            function addToCart(id, name, price, stock) {
                const existingItem = cart.find(item => item.product_id === id);

                if (existingItem) {
                    if (existingItem.qty < stock) {
                        existingItem.qty++;
                    } else {
                        alert('Stok tidak cukup!');
                        return;
                    }
                } else {
                    cart.push({
                        product_id: id,
                        name: name,
                        price: price,
                        qty: 1,
                        stock: stock
                    });
                }

                updateCart();
            }

            function removeFromCart(id) {
                cart = cart.filter(item => item.product_id !== id);
                updateCart();
            }

            function updateQty(id, qty) {
                const item = cart.find(item => item.product_id === id);
                if (item) {
                    if (qty <= 0) {
                        removeFromCart(id);
                    } else if (qty <= item.stock) {
                        item.qty = qty;
                        updateCart();
                    } else {
                        alert('Stok tidak cukup!');
                    }
                }
            }

            function updateCart() {
                const cartItems = document.getElementById('cart-items');
                totalHarga = 0;

                if (cart.length === 0) {
                    cartItems.innerHTML = '<p class="text-sm text-gray-500 text-center py-8">Belum ada produk</p>';
                    document.getElementById('cart-count').textContent = '0 item';
                } else {
                    cartItems.innerHTML = cart.map(item => {
                        const subtotal = item.price * item.qty;
                        totalHarga += subtotal;

                        return `
                                        <div class="flex justify-between items-center p-3 bg-white border border-gray-200 rounded-lg hover:shadow-md transition-all">
                                            <div class="flex-1">
                                                <p class="font-semibold text-sm text-gray-900">${item.name}</p>
                                                <p class="text-xs text-gray-600 mt-1">Rp ${item.price.toLocaleString('id-ID')}</p>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <button onclick="updateQty(${item.product_id}, ${item.qty - 1})" 
                                                    class="px-2.5 py-1 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold text-sm">−</button>
                                                <span class="px-3 font-bold text-gray-900 text-sm">${item.qty}</span>
                                                <button onclick="updateQty(${item.product_id}, ${item.qty + 1})" 
                                                    class="px-2.5 py-1 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold text-sm">+</button>
                                                <button onclick="removeFromCart(${item.product_id})" 
                                                    class="ml-2 px-2.5 py-1 text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition font-bold">×</button>
                                            </div>
                                        </div>
                                    `;
                    }).join('');

                    document.getElementById('cart-count').textContent = cart.length + ' item';
                }

                // Update totals
                document.getElementById('subtotal').textContent = 'Rp ' + totalHarga.toLocaleString('id-ID');
                document.getElementById('total').textContent = 'Rp ' + totalHarga.toLocaleString('id-ID');
                hitungKembalian();
            }

            function hitungKembalian() {
                const bayar = parseFloat(document.getElementById('bayar').value) || 0;
                const kembalian = bayar - totalHarga;
                const kembalianEl = document.getElementById('kembalian');

                if (bayar < totalHarga) {
                    kembalianEl.textContent = 'Rp ' + (totalHarga - bayar).toLocaleString('id-ID');
                    kembalianEl.parentElement.className = 'bg-red-50 rounded-lg p-3 border border-red-200';
                } else {
                    kembalianEl.textContent = 'Rp ' + kembalian.toLocaleString('id-ID');
                    kembalianEl.parentElement.className = 'bg-green-50 rounded-lg p-3 border border-green-200';
                }
            }

            function resetCart() {
                if (cart.length === 0) {
                    alert('Keranjang sudah kosong!');
                    return;
                }

                if (confirm('Yakin ingin mengosongkan keranjang?')) {
                    cart = [];
                    totalHarga = 0;
                    document.getElementById('bayar').value = '';
                    updateCart();
                }
            }

            function prosesTransaksi() {
                if (cart.length === 0) {
                    alert('Keranjang masih kosong! Silakan tambahkan produk.');
                    return;
                }

                const bayar = parseFloat(document.getElementById('bayar').value) || 0;

                if (bayar === 0) {
                    alert('Masukkan jumlah pembayaran!');
                    document.getElementById('bayar').focus();
                    return;
                }

                if (bayar < totalHarga) {
                    alert('Pembayaran tidak cukup! Kurang: Rp ' + (totalHarga - bayar).toLocaleString('id-ID'));
                    document.getElementById('bayar').focus();
                    return;
                }

                console.log('Cart Data:', cart);
                console.log('Total:', totalHarga);
                console.log('Bayar:', bayar);

                // Submit form dengan data yang benar
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("transactions.store") }}';

                // CSRF Token
                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                form.appendChild(csrf);

                // Bayar
                const bayarInput = document.createElement('input');
                bayarInput.type = 'hidden';
                bayarInput.name = 'bayar';
                bayarInput.value = bayar;
                form.appendChild(bayarInput);

                // Cart items
                cart.forEach((item, index) => {
                    const productIdInput = document.createElement('input');
                    productIdInput.type = 'hidden';
                    productIdInput.name = `cart[${index}][product_id]`;
                    productIdInput.value = item.product_id;
                    form.appendChild(productIdInput);

                    const qtyInput = document.createElement('input');
                    qtyInput.type = 'hidden';
                    qtyInput.name = `cart[${index}][qty]`;
                    qtyInput.value = item.qty;
                    form.appendChild(qtyInput);
                });

                console.log('Form HTML:', form.innerHTML);

                document.body.appendChild(form);
                form.submit();
            }
        </script>
    @endpush
@endsection