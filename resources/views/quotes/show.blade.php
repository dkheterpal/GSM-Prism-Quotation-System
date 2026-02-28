@extends('layouts.app')
@section('title', 'Quote ' . $quote->quote_number)

@section('content')
    <div class="max-w-5xl mx-auto align-middle animate-fade-in" style="animation-delay: 0.1s;">
        <div class="mb-6 flex justify-between items-center print:hidden">
            <div>
                <a href="{{ route('quotes.index') }}"
                    class="text-slate-600 font-medium hover:text-slate-900 hover:underline mb-2 inline-flex items-center gap-2"><i
                        class="fa-solid fa-arrow-left"></i> Back to Quotes</a>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('quotes.edit', $quote->id) }}"
                    class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-semibold py-2 px-5 rounded-lg shadow-sm transition-all flex items-center gap-2">
                    <i class="fa-solid fa-pencil"></i> Edit
                </a>
                <a href="{{ route('quotes.download', $quote->id) }}"
                    class="bg-slate-900 hover:bg-slate-800 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition-all flex items-center gap-2">
                    <i class="fa-solid fa-file-pdf"></i> Download PDF
                </a>
                <button onclick="window.print()"
                    class="bg-slate-900 hover:bg-slate-800 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition-all flex items-center gap-2">
                    <i class="fa-solid fa-print"></i> Print
                </button>
            </div>
        </div>

        <div class="bg-white p-8 md:p-12 border border-slate-200 shadow-xl shadow-slate-200/50 rounded-2xl mb-10 print:shadow-none print:border-none print:p-0">
            <!-- Header -->
            <div class="flex justify-between items-start border-b-2 border-slate-900 pb-6 mb-8">
                <div>
                    <h1 class="text-4xl font-bold text-slate-900 mb-2">Proposal</h1>
                    <div class="flex items-center gap-3">
                        <p class="text-xl text-slate-500 font-mono">{{ $quote->quote_number }}</p>
                        @php
                            $statusClass = 'bg-slate-100 text-slate-600 border-slate-200';
                            $statusStr = strtolower($quote->status);
                            if ($statusStr === 'active') $statusClass = 'bg-emerald-50 text-emerald-600 border-emerald-200';
                            elseif ($statusStr === 'draft') $statusClass = 'bg-amber-50 text-amber-600 border-amber-200';
                            elseif ($statusStr === 'sent') $statusClass = 'bg-blue-50 text-blue-600 border-blue-200';
                            elseif ($statusStr === 'accepted') $statusClass = 'bg-green-50 text-green-700 border-green-200';
                            elseif ($statusStr === 'rejected') $statusClass = 'bg-red-50 text-red-600 border-red-200';
                            if ($quote->trashed()) $statusClass = 'bg-slate-100 text-slate-500 border-slate-200 line-through';
                        @endphp
                        <span class="capitalize {{ $statusClass }} border rounded-full px-3 py-1 text-xs font-bold tracking-wide shadow-sm flex items-center w-fit print:hidden">
                            <i class="fa-solid {{ $quote->trashed() ? 'fa-trash-can' : 'fa-circle-dot' }} text-[8px] mr-1 mb-[1px]"></i>{{ $quote->trashed() ? 'Deleted' : $quote->status }}
                        </span>
                    </div>
                    <p class="text-slate-400 mt-2">Date: {{ $quote->created_at->format('F j, Y') }}</p>
                </div>
                <div class="text-right">
                    <h3 class="text-xs uppercase tracking-widest font-bold text-slate-400 mb-2">Submitted To</h3>
                    @if($quote->company_logo)
                        <img src="{{ url($quote->company_logo) }}" class="max-h-12 mb-2 object-contain ml-auto">
                    @endif
                    <p class="font-bold text-lg text-slate-900">{{ $quote->company_name ?: 'Company' }}</p>
                    <p class="text-slate-700 font-medium">c/o {{ $quote->customer_name }}</p>
                    @if($quote->address || $quote->city)
                        <p class="text-slate-500 text-sm mt-1">
                            {{ $quote->address }}<br>
                            @if($quote->city){{ $quote->city }}, {{ $quote->state }} {{ $quote->pincode }}@endif
                        </p>
                    @endif
                    @if($quote->email || $quote->phone)
                        <div class="mt-2 text-sm text-slate-600">
                            @if($quote->email)<p>{{ $quote->email }}</p>@endif
                            @if($quote->phone)<p>{{ $quote->phone }}</p>@endif
                        </div>
                    @endif
                </div>
            </div>

            @if($quote->notes)
                <div class="mb-8 p-5 bg-amber-50 rounded-xl border border-amber-200 text-amber-800 shadow-sm print:hidden">
                    <h4 class="font-bold mb-1"><i class="fa-solid fa-note-sticky mr-2"></i>Internal Notes</h4>
                    <p class="text-sm whitespace-pre-wrap">{{ $quote->notes }}</p>
                </div>
            @endif

            <!-- Investment Summary -->
            <div class="mb-12">
                <h3 class="text-2xl font-bold text-slate-900 border-b border-slate-200 pb-3 mb-6">Investment Summary</h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse border border-slate-200 rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-slate-900 text-white">
                                <th class="p-4 font-semibold text-sm w-32 text-center">Image</th>
                                <th class="p-4 font-semibold text-sm">Product Name</th>
                                <th class="p-4 font-semibold text-sm text-center">Type</th>
                                <th class="p-4 font-semibold text-sm text-center">Qty</th>
                                <th class="p-4 font-semibold text-sm text-right">Pricing</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @foreach($quote->items as $item)
                                <tr class="bg-white hover:bg-slate-50">
                                    <td class="p-4 align-middle text-center">
                                        @if($item->product->image_path)
                                            <div class="w-20 h-20 rounded border border-slate-200 bg-white flex items-center justify-center p-1 overflow-hidden shrink-0 mx-auto">
                                                <img src="{{ url($item->product->image_path) }}" class="max-w-full max-h-full object-contain" alt="{{ $item->product->name }}">
                                            </div>
                                        @else
                                            <div class="w-20 h-20 rounded border border-slate-200 bg-slate-50 flex items-center justify-center shrink-0 mx-auto text-slate-300">
                                                <i class="fa-solid fa-image text-2xl"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="p-4 align-middle">
                                        <div class="font-bold text-lg text-slate-900">{{ $item->product->name }}</div>
                                    </td>
                                    <td class="p-4 align-middle text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                            {{ $item->price->type }}
                                        </span>
                                    </td>
                                    <td class="p-4 align-middle text-center">
                                        <div class="text-slate-700 font-semibold">{{ $item->quantity }}</div>
                                    </td>
                                    <td class="p-4 align-middle text-right">
                                        @if($item->price->type === 'Included')
                                            <div class="text-slate-900 font-bold text-sm uppercase">Included</div>
                                        @elseif($item->price->type === 'Fixed')
                                            <div class="text-slate-900 font-bold">${{ number_format($item->price->setup_fee, 2) }}</div>
                                        @else
                                            <div class="text-slate-900 font-bold">${{ number_format($item->price->monthly_fee, 2) }}/mo</div>
                                            @if($item->price->setup_fee > 0)
                                                <div class="text-slate-500 text-sm mt-1">+ ${{ number_format($item->price->setup_fee, 2) }} setup</div>
                                            @endif
                                            @if($item->price->term_months)
                                                <div class="text-slate-400 text-xs mt-0.5">Term: {{ $item->price->term_months }} mo</div>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @php
                $totalCapital = 0;
                $totalSaaSMonthly = 0;
                $totalHaaSMonthly = 0;

                foreach($fixedItems as $item) {
                    $totalCapital += $item->price->setup_fee * $item->quantity;
                }
                foreach($saasItems as $item) {
                    $totalCapital += $item->price->setup_fee * $item->quantity;
                    $totalSaaSMonthly += $item->price->monthly_fee * $item->quantity;
                }
                foreach($haasItems as $item) {
                    $totalCapital += $item->price->setup_fee * $item->quantity;
                    $totalHaaSMonthly += $item->price->monthly_fee * $item->quantity;
                }
            @endphp

            @if($totalCapital > 0 || $totalSaaSMonthly > 0 || $totalHaaSMonthly > 0)
                <div class="bg-slate-900 rounded-xl p-6 md:p-8 text-white mb-8 shadow-lg">
                    <h3 class="text-xl font-bold border-b border-slate-700 pb-4 mb-6"><i class="fa-solid fa-calculator mr-2 text-brand-400"></i> Total Investment Profile</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div class="bg-slate-800/80 rounded-lg p-5 border border-slate-700">
                            <p class="text-slate-400 text-sm uppercase tracking-wider font-bold mb-1">Total Upfront (Capital + Setup)</p>
                            <p class="text-3xl font-bold text-white">${{ number_format($totalCapital, 2) }}</p>
                        </div>
                        <div class="bg-slate-800/80 rounded-lg p-5 border border-slate-700">
                            <p class="text-slate-400 text-sm uppercase tracking-wider font-bold mb-1">Total SaaS / Month</p>
                            <p class="text-3xl font-bold text-white">${{ number_format($totalSaaSMonthly, 2) }}</p>
                        </div>
                        <div class="bg-slate-800/80 rounded-lg p-5 border border-slate-700">
                            <p class="text-slate-400 text-sm uppercase tracking-wider font-bold mb-1">Total HaaS / Month</p>
                            <p class="text-3xl font-bold text-white">${{ number_format($totalHaaSMonthly, 2) }}</p>
                        </div>
                    </div>
                </div>
            @endif
            
            <div class="mt-12 text-sm text-slate-500 border-t border-slate-200 pt-6">
                <p>This is a strictly confidential document intended solely for the recipient.</p>
            </div>
        </div>
    </div>
@endsection
