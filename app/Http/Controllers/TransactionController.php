<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', 0)->with('category')->get();
        return view('transactions.index', compact('products'));
    }

    public function store(Request $request)
    {
        try {
            // Validasi basic
            if (!$request->has('cart') || !is_array($request->cart) || empty($request->cart)) {
                if ($request->expectsJson()) {
                    return response()->json(['error' => 'Keranjang kosong!'], 400);
                }
                return back()->with('error', 'Keranjang kosong!');
            }

            if (!$request->has('bayar') || $request->bayar <= 0) {
                if ($request->expectsJson()) {
                    return response()->json(['error' => 'Jumlah pembayaran tidak valid!'], 400);
                }
                return back()->with('error', 'Jumlah pembayaran tidak valid!');
            }

            DB::beginTransaction();

            $total = 0;
            $cart = $request->cart;

            // Hitung total dan validasi produk
            foreach ($cart as $item) {
                if (!isset($item['product_id']) || !isset($item['qty'])) {
                    DB::rollBack();
                    $msg = 'Data keranjang tidak valid!';
                    if ($request->expectsJson()) {
                        return response()->json(['error' => $msg], 400);
                    }
                    return back()->with('error', $msg);
                }

                $product = Product::find($item['product_id']);
                if (!$product) {
                    DB::rollBack();
                    $msg = 'Produk tidak ditemukan!';
                    if ($request->expectsJson()) {
                        return response()->json(['error' => $msg], 400);
                    }
                    return back()->with('error', $msg);
                }

                $qty = intval($item['qty']);
                if ($qty <= 0) {
                    DB::rollBack();
                    $msg = 'Jumlah produk tidak valid!';
                    if ($request->expectsJson()) {
                        return response()->json(['error' => $msg], 400);
                    }
                    return back()->with('error', $msg);
                }

                if ($product->stock < $qty) {
                    DB::rollBack();
                    $msg = 'Stok ' . $product->name . ' tidak cukup! Stok tersedia: ' . $product->stock;
                    if ($request->expectsJson()) {
                        return response()->json(['error' => $msg], 400);
                    }
                    return back()->with('error', $msg);
                }

                $total += $product->price * $qty;
            }

            // Validasi pembayaran
            $bayar = floatval($request->bayar);
            if ($bayar < $total) {
                DB::rollBack();
                $msg = 'Pembayaran tidak cukup! Total: Rp ' . number_format($total, 0, ',', '.');
                if ($request->expectsJson()) {
                    return response()->json(['error' => $msg], 400);
                }
                return back()->with('error', $msg);
            }

            $kembalian = $bayar - $total;

            // Simpan transaksi
            $transaction = Transaction::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'bayar' => $bayar,
                'kembalian' => $kembalian,
                'tanggal' => now(),
            ]);

            // Simpan detail dan kurangi stok
            foreach ($cart as $item) {
                $product = Product::find($item['product_id']);
                $qty = intval($item['qty']);

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['product_id'],
                    'qty' => $qty,
                    'subtotal' => $product->price * $qty,
                ]);

                // Kurangi stok
                $product->decrement('stock', $qty);
            }

            DB::commit();

            // Handle response untuk AJAX dan form biasa
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'redirect' => route('transactions.receipt', $transaction->id)
                ]);
            }

            return redirect()->route('transactions.receipt', $transaction->id)
                ->with('success', 'Transaksi berhasil!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Transaction Error: ' . $e->getMessage() . ' ' . $e->getFile() . ':' . $e->getLine());

            $msg = 'Terjadi kesalahan: ' . $e->getMessage();

            if ($request->expectsJson()) {
                return response()->json(['error' => $msg], 500);
            }

            return back()->with('error', $msg);
        }
    }

    public function receipt($id)
    {
        $transaction = Transaction::with(['details.product', 'user'])->findOrFail($id);
        return view('transactions.receipt', compact('transaction'));
    }

    public function history()
    {
        $transactions = Transaction::with('user')->latest()->paginate(20);

        // Hitung pendapatan hari ini
        $todayRevenue = Transaction::whereDate('tanggal', today())->sum('total');
        $todayTransactions = Transaction::whereDate('tanggal', today())->count();

        return view('transactions.history', compact('transactions', 'todayRevenue', 'todayTransactions'));
    }
}
