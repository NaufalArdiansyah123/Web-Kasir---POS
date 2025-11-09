@extends('layouts.app')

@section('title', 'Laporan Penjualan')
@section('page-title', 'Laporan Penjualan')

@section('content')
    <div class="mb-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <form method="GET" action="{{ route('reports.index') }}" class="flex gap-4 items-end">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Filter Periode</label>
                    <select name="filter"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        onchange="toggleCustomDate(this.value)">
                        <option value="daily" {{ $filter == 'daily' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="weekly" {{ $filter == 'weekly' ? 'selected' : '' }}>Minggu Ini</option>
                        <option value="monthly" {{ $filter == 'monthly' ? 'selected' : '' }}>Bulan Ini</option>
                        <option value="custom" {{ $filter == 'custom' ? 'selected' : '' }}>Custom</option>
                    </select>
                </div>

                <div id="custom-date" class="flex-1 {{ $filter != 'custom' ? 'hidden' : '' }}">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div id="custom-date-end" class="flex-1 {{ $filter != 'custom' ? 'hidden' : '' }}">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Filter
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-sm text-gray-600 mb-2">Total Pendapatan</h3>
            <p class="text-3xl font-bold text-blue-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-sm text-gray-600 mb-2">Total Transaksi</h3>
            <p class="text-3xl font-bold text-green-600">{{ $totalTransactions }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <h3 class="text-lg font-semibold mb-4">Grafik Penjualan</h3>
        <canvas id="salesChart" height="100"></canvas>
    </div>

    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold">Detail Transaksi</h3>
        </div>

        <div class="p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No. Transaksi
                        </th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kasir
                        </th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($transactions as $transaction)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    #{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $transaction->user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $transaction->tanggal->format('d M Y H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">Rp
                                    {{ number_format($transaction->total, 0, ',', '.') }}</div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                Tidak ada transaksi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-gray-200">
            {{ $transactions->links() }}
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            function toggleCustomDate(value) {
                const customDate = document.getElementById('custom-date');
                const customDateEnd = document.getElementById('custom-date-end');

                if (value === 'custom') {
                    customDate.classList.remove('hidden');
                    customDateEnd.classList.remove('hidden');
                } else {
                    customDate.classList.add('hidden');
                    customDateEnd.classList.add('hidden');
                }
            }

            const ctx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($chartData['labels']),
                    datasets: [{
                        label: 'Penjualan (Rp)',
                        data: @json($chartData['data']),
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
        </script>
    @endpush
@endsection