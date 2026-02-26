<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\Product;
use App\Models\Price;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::orderBy('created_at', 'desc')->get();
        return view('quotes.index', compact('quotes'));
    }

    public function create()
    {
        return view('quotes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.price_id' => 'required|exists:prices,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $quote = Quote::create([
            'quote_number' => 'GSM-' . date('Ymd') . '-' . rand(1000, 9999),
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
        ]);

        foreach ($request->items as $item) {
            $quote->items()->create([
                'product_id' => $item['product_id'],
                'price_id' => $item['price_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        return response()->json(['success' => true, 'redirect' => route('quotes.index')]);
    }

    public function download($id)
    {
        // Placeholder for downloading functionality
        return back()->with('success', 'Download functionality will be implemented soon.');
    }

    public function apiProducts()
    {
        return response()->json(Product::select('id', 'name')->get());
    }

    public function apiPrices($id)
    {
        return response()->json(Price::where('product_id', $id)->get());
    }
}
