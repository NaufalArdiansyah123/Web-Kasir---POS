@extends('layouts.app')

@section('title', 'Produk')
@section('page-title', 'Daftar Produk')

@section('content')
    <div class="bg-white rounded-2xl shadow-lg">
        <div class="p-6 border-b border-gray-100">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="bg-blue-600 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Daftar Produk</h3>
                </div>
                <button onclick="openProductModal()"
                    class="flex items-center px-4 py-2.5 bg-blue-600 text-white rounded-xl hover:shadow-lg hover:shadow-blue-600/50 transition-all duration-300 transform hover:-translate-y-0.5 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Produk
                </button>
            </div>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th
                                class="px-6 py-4 bg-gray-100 text-left text-xs font-bold text-gray-700 uppercase tracking-wider rounded-tl-xl">
                                Nama Produk
                            </th>
                            <th
                                class="px-6 py-4 bg-gray-100 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th
                                class="px-6 py-4 bg-gray-100 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Harga
                            </th>
                            <th
                                class="px-6 py-4 bg-gray-100 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Stok
                            </th>
                            <th
                                class="px-6 py-4 bg-gray-100 text-right text-xs font-bold text-gray-700 uppercase tracking-wider rounded-tr-xl">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($products as $product)
                            <tr
                                class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-transparent transition-all duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $product->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1.5 inline-flex text-xs font-bold rounded-full bg-blue-100 text-blue-700 border border-blue-300">
                                        {{ $product->category->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1.5 inline-flex text-xs font-bold rounded-full border {{ $product->stock < 10 ? 'bg-gray-100 text-gray-700 border-gray-300' : 'bg-blue-100 text-blue-700 border-blue-300' }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button type="button" onclick="openProductModal({{ $product->id }})"
                                        class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white rounded-lg hover:shadow-lg hover:shadow-blue-600/50 transition-all duration-300 mr-2 text-xs font-semibold cursor-pointer">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </button>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 bg-gray-700 text-white rounded-lg hover:shadow-lg hover:shadow-gray-700/50 transition-all duration-300 text-xs font-semibold"
                                            onclick="return confirm('Yakin ingin menghapus?')">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    <p class="text-sm text-gray-500">Belum ada produk</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-gray-200">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Produk -->
    <div id="productModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center overflow-y-auto">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 my-8">
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="bg-blue-600 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <h3 id="modalTitle" class="text-lg font-bold text-gray-800">Tambah Produk</h3>
                </div>
                <button onclick="closeProductModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="productForm" method="POST" class="p-6 space-y-6">
                @csrf
                <input type="hidden" id="methodField" name="_method" value="POST">

                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk</label>
                    <input type="text" name="name" id="name"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                        placeholder="Masukkan nama produk" required>
                    <p id="nameError" class="mt-2 text-sm text-red-600 hidden"></p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                        <select name="category_id" id="category_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                            required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories ?? [] as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <p id="category_idError" class="mt-2 text-sm text-red-600 hidden"></p>
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">Stok</label>
                        <input type="number" name="stock" id="stock"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                            placeholder="0" required min="0">
                        <p id="stockError" class="mt-2 text-sm text-red-600 hidden"></p>
                    </div>
                </div>

                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Harga</label>
                    <input type="number" name="price" id="price"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                        placeholder="0" required min="0" step="0.01">
                    <p id="priceError" class="mt-2 text-sm text-red-600 hidden"></p>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:shadow-lg hover:shadow-blue-600/50 transition-all duration-300 font-semibold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span id="submitText">Simpan</span>
                    </button>
                    <button type="button" onclick="closeProductModal()"
                        class="flex-1 px-6 py-3 bg-gray-700 text-white rounded-xl hover:bg-gray-800 transition-all duration-200 font-semibold">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            let productModalOpen = false;
            const categories = @json($categories ?? []);

            function openProductModal(productId = null) {
                const modal = document.getElementById('productModal');
                const form = document.getElementById('productForm');
                const modalTitle = document.getElementById('modalTitle');
                const methodField = document.getElementById('methodField');
                const submitText = document.getElementById('submitText');

                if (productId) {
                    // Edit mode
                    modalTitle.textContent = 'Edit Produk';
                    submitText.textContent = 'Update';
                    methodField.value = 'PUT';

                    // Show modal first
                    modal.classList.remove('hidden');
                    productModalOpen = true;

                    // Fetch product data
                    fetch(`/products/${productId}/edit`, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                        .then(response => {
                            if (!response.ok) throw new Error('Network response was not ok');
                            return response.json();
                        })
                        .then(data => {
                            document.getElementById('name').value = data.name;
                            document.getElementById('category_id').value = data.category_id;
                            document.getElementById('price').value = data.price;
                            document.getElementById('stock').value = data.stock;
                            form.action = `/products/${productId}`;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Gagal memuat data produk');
                            closeProductModal();
                        });
                } else {
                    // Create mode
                    modalTitle.textContent = 'Tambah Produk';
                    submitText.textContent = 'Simpan';
                    methodField.value = 'POST';
                    form.action = '{{ route("products.store") }}';
                    form.reset();
                    modal.classList.remove('hidden');
                    productModalOpen = true;
                }
            }

            function closeProductModal() {
                const modal = document.getElementById('productModal');
                modal.classList.add('hidden');
                productModalOpen = false;
            }

            // Close modal when clicking outside
            document.getElementById('productModal').addEventListener('click', function (e) {
                if (e.target === this) {
                    closeProductModal();
                }
            });

            // Handle form submission
            document.getElementById('productForm').addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                const method = document.getElementById('methodField').value;
                const action = this.action;

                fetch(action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams(formData)
                })
                    .then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            return response.json().then(data => {
                                // Clear previous errors
                                document.getElementById('nameError').classList.add('hidden');
                                document.getElementById('category_idError').classList.add('hidden');
                                document.getElementById('priceError').classList.add('hidden');
                                document.getElementById('stockError').classList.add('hidden');

                                if (data.errors) {
                                    if (data.errors.name) {
                                        document.getElementById('nameError').textContent = data.errors.name[0];
                                        document.getElementById('nameError').classList.remove('hidden');
                                    }
                                    if (data.errors.category_id) {
                                        document.getElementById('category_idError').textContent = data.errors.category_id[0];
                                        document.getElementById('category_idError').classList.remove('hidden');
                                    }
                                    if (data.errors.price) {
                                        document.getElementById('priceError').textContent = data.errors.price[0];
                                        document.getElementById('priceError').classList.remove('hidden');
                                    }
                                    if (data.errors.stock) {
                                        document.getElementById('stockError').textContent = data.errors.stock[0];
                                        document.getElementById('stockError').classList.remove('hidden');
                                    }
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menyimpan data');
                    });
            });
        </script>
    @endpush
@endsection