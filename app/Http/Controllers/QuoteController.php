<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\Product;
use App\Models\Price;

class QuoteController extends Controller
{
    public function index(Request $request)
    {
        $query = Quote::orderBy('created_at', 'desc');
        $currentStatus = $request->input('status', 'Active');

        if ($currentStatus === 'deleted') {
            $query->onlyTrashed();
        } else {
            // Also allow filtering by specific status if we want
            if ($currentStatus !== 'all') {
                $query->where('status', $currentStatus);
            }
        }

        $search = $request->input('search');
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'LIKE', "%{$search}%")
                    ->orWhere('company_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('address', 'LIKE', "%{$search}%")
                    ->orWhere('city', 'LIKE', "%{$search}%")
                    ->orWhere('state', 'LIKE', "%{$search}%")
                    ->orWhere('quote_number', 'LIKE', "%{$search}%")
                    ->orWhereHas('items.product', function ($qProduct) use ($search) {
                        $qProduct->where('name', 'LIKE', "%{$search}%")
                            ->orWhere('description', 'LIKE', "%{$search}%")
                            ->orWhere('deliverables', 'LIKE', "%{$search}%");
                    });
            });
        }

        $quotes = $query->paginate(5)->withQueryString();

        return view('quotes.index', compact('quotes', 'currentStatus'));
    }

    public function create()
    {
        return view('quotes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.price_id' => 'required|exists:prices,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $logoPath = null;
        if ($request->filled('company_logo_base64')) {
            $base64 = $request->input('company_logo_base64');
            $image_parts = explode(";base64,", $base64);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1] ?? 'png';
            $image_base64 = base64_decode($image_parts[1]);

            $fileName = 'logo_' . uniqid() . '.' . $image_type;
            $path = public_path('images/logos/');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            file_put_contents($path . $fileName, $image_base64);
            $logoPath = '/images/logos/' . $fileName;
        }

        $quote = Quote::create([
            'quote_number' => 'GSM-' . strtoupper(substr(uniqid(), -4)) . '-' . date('Ymd'),
            'customer_name' => $request->customer_name,
            'company_name' => $request->company_name,
            'company_logo' => $logoPath,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'city' => $request->city,
            'state' => $request->state,
            'status' => 'Active',
            'notes' => $request->notes,
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

    public function show($id)
    {
        $quote = Quote::with(['items.product', 'items.price'])->withTrashed()->findOrFail($id);

        $uniqueProducts = collect();
        foreach ($quote->items as $item) {
            $uniqueProducts->push($item->product);
        }
        $uniqueProducts = $uniqueProducts->unique('id')->values();

        // Always append Technology Architecture and Support products at the end
        $tech = Product::where('name', 'Technology Architecture')->first();
        if ($tech && !$uniqueProducts->contains('id', $tech->id)) {
            $uniqueProducts->push($tech);
        }

        $support = Product::where('name', 'Support, Warranty, and Maintenance Services')->first();
        if ($support && !$uniqueProducts->contains('id', $support->id)) {
            $uniqueProducts->push($support);
        }

        $fixedItems = $quote->items->filter(fn($i) => $i->price->type === 'Fixed');
        $saasItems = $quote->items->filter(fn($i) => $i->price->type === 'SaaS');
        $haasItems = $quote->items->filter(fn($i) => $i->price->type === 'HaaS');

        return view('quotes.show', compact('quote', 'uniqueProducts', 'fixedItems', 'saasItems', 'haasItems'));
    }

    public function edit($id)
    {
        $quote = Quote::with('items.product', 'items.price')->withTrashed()->findOrFail($id);
        return view('quotes.edit', compact('quote'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.price_id' => 'required|exists:prices,id',
            'items.*.quantity' => 'required|integer|min:1',
            'status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $quote = Quote::withTrashed()->findOrFail($id);

        $logoPath = $quote->company_logo;
        if ($request->filled('company_logo_base64')) {
            // handle new logo
            $base64 = $request->input('company_logo_base64');
            $image_parts = explode(";base64,", $base64);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1] ?? 'png';
            $image_base64 = base64_decode($image_parts[1]);

            $fileName = 'logo_' . uniqid() . '.' . $image_type;
            $path = public_path('images/logos/');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            file_put_contents($path . $fileName, $image_base64);
            $logoPath = '/images/logos/' . $fileName;
        }

        $quote->update([
            'customer_name' => $request->customer_name,
            'company_name' => $request->company_name,
            'company_logo' => $logoPath,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        // Re-create items matching how it was built
        $quote->items()->delete();
        foreach ($request->items as $item) {
            $quote->items()->create([
                'product_id' => $item['product_id'],
                'price_id' => $item['price_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        return response()->json(['success' => true, 'redirect' => route('quotes.index')]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|string']);
        $quote = Quote::withTrashed()->findOrFail($id);
        $quote->update(['status' => $request->status]);

        return back()->with('success', 'Quote status updated.');
    }

    public function updateNotes(Request $request, $id)
    {
        $request->validate(['notes' => 'nullable|string']);
        $quote = Quote::withTrashed()->findOrFail($id);
        $quote->update(['notes' => $request->notes]);

        return back()->with('success', 'Quote notes updated.');
    }

    public function destroy($id)
    {
        $quote = Quote::findOrFail($id);
        $quote->delete();
        return redirect()->route('quotes.index', ['status' => 'Active'])->with('success', 'Quote moved to deleted correctly.');
    }

    public function restore($id)
    {
        $quote = Quote::onlyTrashed()->findOrFail($id);
        $quote->restore();
        // optionally reset status back to active when restored?
        $quote->update(['status' => 'Active']);
        return redirect()->route('quotes.index', ['status' => 'Active'])->with('success', 'Quote restored successfully.');
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
