<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockIn;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    /**
     * Display a listing of stock in records.
     */
    public function index()
    {
        $stockIns = StockIn::with(['product', 'supplier'])
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('stock_ins.index', compact('stockIns'));
    }

    /**
     * Show the form for creating a new stock in record.
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('stock_ins.create', compact('products', 'suppliers'));
    }

    /**
     * Store a newly created stock in record.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $stockIn = StockIn::create($validated);

        // Increase product quantity
        $product = Product::findOrFail($validated['product_id']);
        $product->increment('quantity', $validated['quantity']);

        return redirect()->route('stock-ins.index')
            ->with('success', "Stock in recorded: {$validated['quantity']} units added to \"{$product->name}\".");
    }

    /**
     * Display the specified stock in record.
     */
    public function show(StockIn $stockIn)
    {
        $stockIn->load(['product', 'supplier']);

        return view('stock_ins.show', compact('stockIn'));
    }
}
