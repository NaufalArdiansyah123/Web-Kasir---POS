@extends('layouts.app')

@section('title', 'Kategori')
@section('page-title', 'Daftar Kategori')

@section('content')
    <div class="bg-white rounded-2xl shadow-lg">
        <div class="p-6 border-b border-gray-100">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Kategori Produk</h3>
                </div>
                <button onclick="openCategoryModal()"
                    class="flex items-center px-4 py-2.5 bg-blue-600 text-white rounded-xl hover:shadow-lg hover:shadow-blue-600/50 transition-all duration-300 transform hover:-translate-y-0.5 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kategori
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
                                Nama
                            </th>
                            <th
                                class="px-6 py-4 bg-gray-100 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Deskripsi
                            </th>
                            <th
                                class="px-6 py-4 bg-gray-100 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Jumlah Produk
                            </th>
                            <th
                                class="px-6 py-4 bg-gray-100 text-right text-xs font-bold text-gray-700 uppercase tracking-wider rounded-tr-xl">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($categories as $category)
                            <tr
                                class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-transparent transition-all duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $category->name }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">{{ $category->description ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1.5 inline-flex text-xs font-bold rounded-full bg-blue-100 text-blue-700 border border-blue-300">
                                        {{ $category->products->count() }} produk
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button type="button" onclick="openCategoryModal({{ $category->id }})"
                                        class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white rounded-lg hover:shadow-lg hover:shadow-blue-600/50 transition-all duration-300 mr-2 text-xs font-semibold cursor-pointer">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </button>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                        class="inline-block">
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
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    <p class="text-sm text-gray-500">Belum ada kategori</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-gray-200">
                {{ $categories->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Kategori -->
    <div id="categoryModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4">
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="bg-blue-600 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <h3 id="modalTitle" class="text-lg font-bold text-gray-800">Tambah Kategori</h3>
                </div>
                <button onclick="closeCategoryModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="categoryForm" method="POST" class="p-6 space-y-6">
                @csrf
                <input type="hidden" id="methodField" name="_method" value="POST">

                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Kategori</label>
                    <input type="text" name="name" id="name"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                        placeholder="Masukkan nama kategori" required>
                    <p id="nameError" class="mt-2 text-sm text-red-600 hidden"></p>
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                        placeholder="Masukkan deskripsi kategori (opsional)"></textarea>
                    <p id="descriptionError" class="mt-2 text-sm text-red-600 hidden"></p>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:shadow-lg hover:shadow-blue-600/50 transition-all duration-300 font-semibold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span id="submitText">Simpan</span>
                    </button>
                    <button type="button" onclick="closeCategoryModal()"
                        class="flex-1 px-6 py-3 bg-gray-700 text-white rounded-xl hover:bg-gray-800 transition-all duration-200 font-semibold">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            let categoryModalOpen = false;

            function openCategoryModal(categoryId = null) {
                const modal = document.getElementById('categoryModal');
                const form = document.getElementById('categoryForm');
                const modalTitle = document.getElementById('modalTitle');
                const methodField = document.getElementById('methodField');
                const submitText = document.getElementById('submitText');

                if (categoryId) {
                    // Edit mode
                    modalTitle.textContent = 'Edit Kategori';
                    submitText.textContent = 'Update';
                    methodField.value = 'PUT';

                    // Show modal first
                    modal.classList.remove('hidden');
                    categoryModalOpen = true;

                    // Fetch category data
                    fetch(`/categories/${categoryId}/edit`, {
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
                            document.getElementById('description').value = data.description || '';
                            form.action = `/categories/${categoryId}`;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Gagal memuat data kategori');
                            closeCategoryModal();
                        });
                } else {
                    // Create mode
                    modalTitle.textContent = 'Tambah Kategori';
                    submitText.textContent = 'Simpan';
                    methodField.value = 'POST';
                    form.action = '{{ route("categories.store") }}';
                    form.reset();
                    modal.classList.remove('hidden');
                    categoryModalOpen = true;
                }
            }

            function closeCategoryModal() {
                const modal = document.getElementById('categoryModal');
                modal.classList.add('hidden');
                categoryModalOpen = false;
            }

            // Close modal when clicking outside
            document.getElementById('categoryModal').addEventListener('click', function (e) {
                if (e.target === this) {
                    closeCategoryModal();
                }
            });

            // Handle form submission
            document.getElementById('categoryForm').addEventListener('submit', function (e) {
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
                                document.getElementById('descriptionError').classList.add('hidden');

                                if (data.errors) {
                                    if (data.errors.name) {
                                        document.getElementById('nameError').textContent = data.errors.name[0];
                                        document.getElementById('nameError').classList.remove('hidden');
                                    }
                                    if (data.errors.description) {
                                        document.getElementById('descriptionError').textContent = data.errors.description[0];
                                        document.getElementById('descriptionError').classList.remove('hidden');
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