@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card Total Produk -->
        <div
            class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 text-white transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium mb-1">Total Produk</p>
                    <h3 class="text-3xl font-bold">{{ $totalProducts }}</h3>
                </div>
                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Card Total Kategori -->
        <div
            class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 text-white transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-300 text-sm font-medium mb-1">Total Kategori</p>
                    <h3 class="text-3xl font-bold">{{ $totalCategories }}</h3>
                </div>
                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Card Pendapatan Hari Ini -->
        <div
            class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 text-white transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium mb-1">Pendapatan Hari Ini</p>
                    <h3 class="text-2xl font-bold">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</h3>
                </div>
                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Card Transaksi Hari Ini -->
        <div
            class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 text-white transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-300 text-sm font-medium mb-1">Transaksi Hari Ini</p>
                    <h3 class="text-3xl font-bold">{{ $todayTransactions }}</h3>
                </div>
                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Transaksi Terbaru -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6">
            <div class="flex items-center mb-6">
                <div class="bg-blue-600 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Transaksi Terbaru</h3>
            </div>
            <div class="space-y-3">
                @forelse($recentTransactions as $transaction)
                    <div
                        class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-gray-100 hover:from-blue-50 hover:to-blue-100 rounded-xl transition-all duration-200 border border-gray-100">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">{{ $transaction->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $transaction->tanggal->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        <p class="text-sm font-bold text-blue-600">Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <p class="text-sm text-gray-500">Belum ada transaksi</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Produk Stok Rendah -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6">
            <div class="flex items-center mb-6">
                <div class="bg-gray-700 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Produk Stok Rendah (< 10)</h3>
            </div>
            <div class="space-y-3">
                @forelse($lowStockProducts as $product)
                    <div
                        class="flex items-center justify-between p-4 bg-gray-100 hover:bg-gray-200 rounded-xl transition-all duration-200 border border-gray-300">
                        <div class="flex items-center">
                            <div class="bg-gray-300 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">{{ $product->name }}</p>
                                <p class="text-xs text-gray-500">{{ $product->category->name }}</p>
                            </div>
                        </div>
                        <span
                            class="px-3 py-1.5 text-xs font-bold text-gray-700 bg-gray-300 rounded-full border border-gray-400">
                            Stok: {{ $product->stock }}
                        </span>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm text-gray-500">Semua produk stok aman</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection