<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'daily');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $query = Transaction::query();

        if ($filter == 'daily') {
            $query->whereDate('tanggal', Carbon::today());
        } elseif ($filter == 'weekly') {
            $query->whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter == 'monthly') {
            $query->whereMonth('tanggal', Carbon::now()->month)
                ->whereYear('tanggal', Carbon::now()->year);
        } elseif ($filter == 'custom' && $startDate && $endDate) {
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        }

        $transactions = $query->with('user')->latest()->paginate(20);
        $totalRevenue = $query->sum('total');
        $totalTransactions = $query->count();

        // Data untuk chart
        $chartData = $this->getChartData($filter, $startDate, $endDate);

        return view('reports.index', compact('transactions', 'totalRevenue', 'totalTransactions', 'filter', 'chartData'));
    }

    private function getChartData($filter, $startDate = null, $endDate = null)
    {
        $query = Transaction::select(
            DB::raw('DATE(tanggal) as date'),
            DB::raw('SUM(total) as total')
        );

        if ($filter == 'daily') {
            $query->whereDate('tanggal', Carbon::today());
        } elseif ($filter == 'weekly') {
            $query->whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter == 'monthly') {
            $query->whereMonth('tanggal', Carbon::now()->month)
                ->whereYear('tanggal', Carbon::now()->year);
        } elseif ($filter == 'custom' && $startDate && $endDate) {
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        }

        $data = $query->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'labels' => $data->pluck('date')->map(function ($date) {
                return Carbon::parse($date)->format('d M');
            })->toArray(),
            'data' => $data->pluck('total')->toArray(),
        ];
    }
}
