@extends('layouts.app')

@section('title', 'Struk')
@section('page-title', 'Struk Transaksi')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm p-8" id="receipt">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold">WE-KASIR</h1>
                <p class="text-sm text-gray-600">Point of Sale System</p>
                <p class="text-xs text-gray-500 mt-2">{{ now()->format('d/m/Y H:i') }}</p>
            </div>

            <div class="border-t border-b border-gray-300 py-4 mb-4">
                <table class="w-full text-sm">
                    <tr>
                        <td>No. Transaksi</td>
                        <td class="text-right font-semibold">#{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</td>
                    </tr>
                    <tr>
                        <td>Kasir</td>
                        <td class="text-right">{{ $transaction->user->name }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td class="text-right">{{ $transaction->tanggal->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>

            <div class="mb-4">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Item</th>
                            <th class="text-center py-2">Qty</th>
                            <th class="text-right py-2">Harga</th>
                            <th class="text-right py-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->details as $detail)
                            <tr class="border-b">
                                <td class="py-2">{{ $detail->product->name }}</td>
                                <td class="text-center">{{ $detail->qty }}</td>
                                <td class="text-right">Rp {{ number_format($detail->product->price, 0, ',', '.') }}</td>
                                <td class="text-right font-semibold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="border-t border-gray-300 pt-4 space-y-2">
                <div class="flex justify-between text-lg font-bold">
                    <span>TOTAL</span>
                    <span>Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Bayar</span>
                    <span>Rp {{ number_format($transaction->bayar, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-green-600 font-semibold">
                    <span>Kembalian</span>
                    <span>Rp {{ number_format($transaction->kembalian, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="mt-6 text-center text-sm text-gray-600">
                <p>Terima kasih atas kunjungan Anda</p>
                <p>Barang yang sudah dibeli tidak dapat ditukar</p>
            </div>
        </div>

        <div class="mt-6 flex gap-3 justify-center">
            <button onclick="window.print()"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Cetak Struk
            </button>
            <a href="{{ route('transactions.index') }}"
                class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                Transaksi Baru
            </a>
        </div>
    </div>

    @push('scripts')
        <style>
            @media print {
                body * {
                    visibility: hidden;
                }

                #receipt,
                #receipt * {
                    visibility: visible;
                }

                #receipt {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                }
            }
        </style>
    @endpush
@endsection