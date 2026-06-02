<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockOut;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    /**
     * Display a listing of stock out records.
     */
    public function index()
    {
        $stockOuts = StockOut::with('product')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('stock_outs.index', compact('stockOuts'));
    }

    /**
     * Show the form for creating a new stock out record.
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('stock_outs.create', compact('products'));
    }

    /**
     * Store a newly created stock out record.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        // Check if enough stock is available
        if ($product->quantity < $validated['quantity']) {
            return back()
                ->withErrors(['quantity' => "Insufficient stock. Only {$product->quantity} units available for \"{$product->name}\"."])
                ->withInput();
        }

        StockOut::create($validated);

        // Decrease product quantity
        $product->decrement('quantity', $validated['quantity']);

        return redirect()->route('stock-outs.index')
            ->with('success', "Stock out recorded: {$validated['quantity']} units removed from \"{$product->name}\".");
    }

    /**
     * Display the specified stock out record.
     */
    public function show(StockOut $stockOut)
    {
        $stockOut->load('product');

        return view('stock_outs.show', compact('stockOut'));
    }
}
