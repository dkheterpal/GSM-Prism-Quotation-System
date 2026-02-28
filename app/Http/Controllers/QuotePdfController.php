<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\Product;
use Mpdf\Mpdf;

class QuotePdfController extends Controller
{
    public function download($id)
    {
        $quote = Quote::with(['items.product', 'items.price'])->findOrFail($id);

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

        // Group into prices based on types mapping to the tables:
        // 1. Hardware Cost - Capital (Fixed)
        // 2. Lease to Buy - SaaS (SaaS)
        // 3. Lease to Buy - HaaS (HaaS)

        $fixedItems = $quote->items->filter(fn($i) => $i->price->type === 'Fixed');
        $saasItems = $quote->items->filter(fn($i) => $i->price->type === 'SaaS');
        $haasItems = $quote->items->filter(fn($i) => $i->price->type === 'HaaS');

        $html = view('pdf.quote', compact('quote', 'uniqueProducts', 'fixedItems', 'saasItems', 'haasItems'))->render();

        $mpdf = new Mpdf([
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 30,
            'margin_bottom' => 20,
            'margin_header' => 10,
            'margin_footer' => 10,
            'default_font' => 'helvetica',
        ]);

        $mpdf->WriteHTML($html);

        return response($mpdf->Output('', 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="Proposal-' . $quote->quote_number . '.pdf"');
    }
}
