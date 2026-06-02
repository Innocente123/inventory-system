<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalSuppliers = Supplier::count();

        $lowStockProducts = Product::where('quantity', '<', 10)
            ->orderBy('quantity')
            ->get();

        $lowStockCount = $lowStockProducts->count();

        $recentStockIns = StockIn::with(['product', 'supplier'])
            ->latest()
            ->take(10)
            ->get();

        $recentStockOuts = StockOut::with('product')
            ->latest()
            ->take(10)
            ->get();

        $totalStockInQuantity = StockIn::sum('quantity');
        $totalStockOutQuantity = StockOut::sum('quantity');

        return view('dashboard', compact(
            'totalProducts',
            'totalSuppliers',
            'lowStockProducts',
            'lowStockCount',
            'recentStockIns',
            'recentStockOuts',
            'totalStockInQuantity',
            'totalStockOutQuantity'
        ));
    }
}
