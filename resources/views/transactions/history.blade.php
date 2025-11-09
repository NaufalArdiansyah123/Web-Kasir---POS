@extends('layouts.app')

@section('title', 'Riwayat Transaksi')
@section('page-title', 'Riwayat Transaksi')

@section('content')
    <!-- Card Pendapatan Hari Ini -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium mb-1">Pendapatan Hari Ini</p>
                    <h3 class="text-3xl font-bold">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</h3>
                </div>
                <div class="bg-white/20 p-4 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium mb-1">Transaksi Hari Ini</p>
                    <h3 class="text-3xl font-bold">{{ $todayTransactions }}</h3>
                    <p class="text-green-100 text-xs mt-1">Total transaksi</p>
                </div>
                <div class="bg-white/20 p-4 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center">
                <div class="bg-blue-600 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Semua Riwayat Transaksi</h3>
            </div>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th
                                class="px-6 py-4 bg-gray-100 text-left text-xs font-bold text-gray-700 uppercase tracking-wider rounded-tl-xl">
                                No. Transaksi
                            </th>
                            <th
                                class="px-6 py-4 bg-gray-100 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Kasir
                            </th>
                            <th
                                class="px-6 py-4 bg-gray-100 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th
                                class="px-6 py-4 bg-gray-100 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Total
                            </th>
                            <th
                                class="px-6 py-4 bg-gray-100 text-right text-xs font-bold text-gray-700 uppercase tracking-wider rounded-tr-xl">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($transactions as $transaction)
                            <tr class="hover:bg-blue-50 transition-all duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">
                                        #{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $transaction->user->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600">{{ $transaction->tanggal->format('d M Y H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">Rp
                                        {{ number_format($transaction->total, 0, ',', '.') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('transactions.receipt', $transaction) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white rounded-lg hover:shadow-lg hover:shadow-blue-600/50 transition-all duration-300 text-xs font-semibold">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Struk
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-gray-500 text-sm">Belum ada transaksi</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="p-6 border-t border-gray-200">
            {{ $transactions->links() }}
        </div>
    </div>
@endsection