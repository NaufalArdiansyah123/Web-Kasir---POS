@extends('layouts.app')

@section('title', 'Kelola Stok')
@section('page-title', 'Kelola Stok Barang')

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
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Manajemen Stok Produk</h3>
                        <p class="text-xs text-gray-500">Tambah atau kurangi stok barang</p>
                    </div>
                </div>
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
                                class="px-6 py-4 bg-gray-100 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Stok Saat Ini
                            </th>
                            <th
                                class="px-6 py-4 bg-gray-100 text-center text-xs font-bold text-gray-700 uppercase tracking-wider rounded-tr-xl">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($products as $product)
                            <tr class="hover:bg-blue-50 transition-all duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $product->name }}</div>
                                    @if($product->description)
                                        <div class="text-xs text-gray-500">{{ Str::limit($product->description, 50) }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1.5 inline-flex text-xs font-bold rounded-full bg-blue-100 text-blue-700 border border-blue-300">
                                        {{ $product->category->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="px-4 py-2 inline-flex text-sm font-bold rounded-lg {{ $product->stock < 10 ? 'bg-red-100 text-red-700 border-2 border-red-300' : 'bg-green-100 text-green-700 border-2 border-green-300' }}">
                                        {{ $product->stock }} unit
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <button type="button"
                                        onclick="openStockModal({{ $product->id }}, '{{ $product->name }}', {{ $product->stock }})"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:shadow-lg hover:shadow-blue-600/50 transition-all duration-300 text-xs font-semibold">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Kelola Stok
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="text-gray-500 text-sm">Tidak ada produk</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Kelola Stok -->
    <div id="stockModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="bg-blue-600 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Kelola Stok</h3>
                    </div>
                    <button type="button" onclick="closeStockModal()" class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <form id="stockForm" method="POST" action="">
                @csrf
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk</label>
                        <div class="px-4 py-3 bg-gray-50 rounded-lg border border-gray-200">
                            <p class="text-sm font-semibold text-gray-900" id="modalProductName"></p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Stok Saat Ini</label>
                        <div class="px-4 py-3 bg-blue-50 rounded-lg border-2 border-blue-200">
                            <p class="text-lg font-bold text-blue-700 text-center" id="modalCurrentStock"></p>
                        </div>
                    </div>

                    <div>
                        <label for="stock_change" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tambah/Kurangi Stok
                            <span class="text-xs text-gray-500 font-normal">(gunakan angka negatif untuk mengurangi)</span>
                        </label>
                        <input type="number" name="stock_change" id="stock_change" required
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-blue-600 focus:ring-0 text-lg font-semibold text-center"
                            placeholder="Contoh: 10 atau -5" oninput="calculateNewStock()">
                    </div>

                    <div id="newStockPreview" class="hidden">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Stok Baru (Preview)</label>
                        <div class="px-4 py-3 bg-green-50 rounded-lg border-2 border-green-200">
                            <p class="text-lg font-bold text-green-700 text-center" id="previewNewStock"></p>
                        </div>
                    </div>

                    <div>
                        <label for="note" class="block text-sm font-semibold text-gray-700 mb-2">
                            Catatan (Opsional)
                        </label>
                        <textarea name="note" id="note" rows="2"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-blue-600 focus:ring-0"
                            placeholder="Catatan perubahan stok..."></textarea>
                    </div>
                </div>

                <div class="p-6 border-t border-gray-200 flex gap-3">
                    <button type="button" onclick="closeStockModal()"
                        class="flex-1 px-4 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-all duration-300 font-semibold">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 hover:shadow-lg transition-all duration-300 font-semibold">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            let currentStock = 0;

            function openStockModal(productId, productName, stock) {
                currentStock = stock;

                document.getElementById('modalProductName').textContent = productName;
                document.getElementById('modalCurrentStock').textContent = stock + ' unit';
                document.getElementById('stockForm').action = `/stock/${productId}`;
                document.getElementById('stock_change').value = '';
                document.getElementById('note').value = '';
                document.getElementById('newStockPreview').classList.add('hidden');

                document.getElementById('stockModal').classList.remove('hidden');
                document.getElementById('stockModal').classList.add('flex');
            }

            function closeStockModal() {
                document.getElementById('stockModal').classList.add('hidden');
                document.getElementById('stockModal').classList.remove('flex');
            }

            function calculateNewStock() {
                const change = parseInt(document.getElementById('stock_change').value) || 0;
                const newStock = currentStock + change;
                const previewDiv = document.getElementById('newStockPreview');
                const previewText = document.getElementById('previewNewStock');

                if (change !== 0) {
                    previewDiv.classList.remove('hidden');
                    previewText.textContent = newStock + ' unit';

                    // Change color based on stock level
                    if (newStock < 0) {
                        previewDiv.querySelector('div').className = 'px-4 py-3 bg-red-50 rounded-lg border-2 border-red-200';
                        previewText.className = 'text-lg font-bold text-red-700 text-center';
                    } else if (newStock < 10) {
                        previewDiv.querySelector('div').className = 'px-4 py-3 bg-yellow-50 rounded-lg border-2 border-yellow-200';
                        previewText.className = 'text-lg font-bold text-yellow-700 text-center';
                    } else {
                        previewDiv.querySelector('div').className = 'px-4 py-3 bg-green-50 rounded-lg border-2 border-green-200';
                        previewText.className = 'text-lg font-bold text-green-700 text-center';
                    }
                } else {
                    previewDiv.classList.add('hidden');
                }
            }

            // Close modal when clicking outside
            document.getElementById('stockModal').addEventListener('click', function (e) {
                if (e.target === this) {
                    closeStockModal();
                }
            });
        </script>
    @endpush
@endsection