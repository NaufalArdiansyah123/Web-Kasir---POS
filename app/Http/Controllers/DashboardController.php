<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();

        $todayRevenue = Transaction::whereDate('tanggal', Carbon::today())->sum('total');
        $todayTransactions = Transaction::whereDate('tanggal', Carbon::today())->count();

        $recentTransactions = Transaction::with('user')->latest()->take(5)->get();
        $lowStockProducts = Product::where('stock', '<', 10)->with('category')->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalUsers',
            'todayRevenue',
            'todayTransactions',
            'recentTransactions',
            'lowStockProducts'
        ));
    }
}
