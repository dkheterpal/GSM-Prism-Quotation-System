<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Price;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('prices')->orderBy('created_at', 'desc')->paginate(5);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'deliverables' => 'required|string',
            'project_timeline' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'prices.*.type' => 'required|in:Fixed,SaaS,HaaS,Included',
            'prices.*.setup_fee' => 'required|numeric|min:0',
            'prices.*.monthly_fee' => 'required|numeric|min:0',
            'prices.*.term_months' => 'nullable|integer|min:0',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/products'), $imageName);
            $imagePath = '/images/products/' . $imageName;
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'deliverables' => $request->deliverables,
            'project_timeline' => $request->project_timeline,
            'image_path' => $imagePath,
        ]);

        if ($request->has('prices')) {
            foreach ($request->prices as $priceData) {
                $product->prices()->create([
                    'type' => $priceData['type'],
                    'setup_fee' => $priceData['setup_fee'] ?? 0,
                    'monthly_fee' => $priceData['monthly_fee'] ?? 0,
                    'term_months' => $priceData['term_months'] ?? null,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load('prices');
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'deliverables' => 'required|string',
            'project_timeline' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'prices.*.id' => 'nullable|exists:prices,id',
            'prices.*.type' => 'required|in:Fixed,SaaS,HaaS,Included',
            'prices.*.setup_fee' => 'required|numeric|min:0',
            'prices.*.monthly_fee' => 'required|numeric|min:0',
            'prices.*.term_months' => 'nullable|integer|min:0',
            'prices_to_delete' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/products'), $imageName);
            $product->image_path = '/images/products/' . $imageName;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'deliverables' => $request->deliverables,
            'project_timeline' => $request->project_timeline,
            'image_path' => $product->image_path,
        ]);

        if ($request->has('prices')) {
            foreach ($request->prices as $priceData) {
                if (isset($priceData['id'])) {
                    $price = Price::find($priceData['id']);
                    if ($price && $price->product_id === $product->id) {
                        $price->update([
                            'type' => $priceData['type'],
                            'setup_fee' => $priceData['setup_fee'] ?? 0,
                            'monthly_fee' => $priceData['monthly_fee'] ?? 0,
                            'term_months' => $priceData['term_months'] ?? null,
                        ]);
                    }
                } else {
                    $product->prices()->create([
                        'type' => $priceData['type'],
                        'setup_fee' => $priceData['setup_fee'] ?? 0,
                        'monthly_fee' => $priceData['monthly_fee'] ?? 0,
                        'term_months' => $priceData['term_months'] ?? null,
                    ]);
                }
            }
        }

        if ($request->filled('prices_to_delete')) {
            $priceIdsToDelete = explode(',', $request->prices_to_delete);
            Price::whereIn('id', $priceIdsToDelete)->where('product_id', $product->id)->delete();
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
