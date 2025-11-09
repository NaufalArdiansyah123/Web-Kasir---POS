<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // Check if request wants JSON (AJAX)
        if (request()->wantsJson()) {
            return response()->json($product);
        }

        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    // Stock Management untuk Manajer
    public function stock()
    {
        $products = Product::with('category')->get();
        return view('stock.index', compact('products'));
    }

    public function updateStock(Request $request, Product $product)
    {
        $request->validate([
            'stock_change' => 'required|integer',
            'note' => 'nullable|string|max:255',
        ]);

        $stockChange = intval($request->stock_change);
        $newStock = $product->stock + $stockChange;

        if ($newStock < 0) {
            return back()->with('error', 'Stok tidak boleh kurang dari 0!');
        }

        $product->stock = $newStock;
        $product->save();

        $action = $stockChange > 0 ? 'ditambah' : 'dikurangi';
        $message = "Stok {$product->name} berhasil {$action} sebanyak " . abs($stockChange) . " unit.";

        return back()->with('success', $message);
    }
}

