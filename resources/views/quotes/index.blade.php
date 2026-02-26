@extends('layouts.app')
@section('title', 'Quotes Dashboard')

@section('content')
    <div class="flex justify-between items-end mb-8 animate-fade-in" style="animation-delay: 0.1s;">
        <div>
            <h2 class="text-3xl font-bold tracking-tight text-slate-900 border-b-4 border-brand-500 pb-2 inline-block">
                Quotes Dashboard</h2>
            <p class="text-slate-500 mt-3 text-sm font-medium">Manage and generate customer proposals</p>
        </div>
        <a href="{{ route('quotes.create') }}"
            class="bg-brand-600 hover:bg-brand-500 text-white font-semibold py-2.5 px-6 rounded-lg shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center gap-2">
            <i class="fa-solid fa-plus-circle"></i> Create New Quote
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden animate-fade-in"
        style="animation-delay: 0.2s;">
        @if(count($quotes) > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 font-semibold text-sm">
                            <th class="p-5 font-semibold text-slate-700">Quote #</th>
                            <th class="p-5 font-semibold text-slate-700">Customer</th>
                            <th class="p-5 font-semibold text-slate-700">Date</th>
                            <th class="p-5 font-semibold text-slate-700">Items</th>
                            <th class="p-5 font-semibold text-slate-700">Status</th>
                            <th class="p-5 font-semibold text-slate-700 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @foreach($quotes as $quote)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="p-5 font-mono font-semibold text-slate-900">{{ $quote->quote_number }}</td>
                                <td class="p-5">
                                    <div class="font-semibold text-slate-800">{{ $quote->customer_name }}</div>
                                    @if($quote->email)
                                        <div class="text-slate-500 text-xs mt-1"><i
                                    class="fa-regular fa-envelope mr-1"></i>{{ $quote->email }}</div>@endif
                                </td>
                                <td class="p-5 text-slate-600">{{ $quote->created_at->format('M j, Y') }}<br><span
                                        class="text-xs text-slate-400">{{ $quote->created_at->format('g:i A') }}</span></td>
                                <td class="p-5">
                                    <span
                                        class="bg-brand-50 text-brand-700 border border-brand-200 font-bold py-1 px-3 rounded-full text-xs shadow-sm">
                                        {{ $quote->items->count() }}
                                    </span>
                                </td>
                                <td class="p-5">
                                    <span
                                        class="capitalize bg-amber-50 text-amber-600 border border-amber-200 rounded-full px-3 py-1 text-xs font-bold tracking-wide shadow-sm">
                                        <i class="fa-solid fa-circle-dot text-[8px] mr-1 mb-[1px]"></i>{{ $quote->status }}
                                    </span>
                                </td>
                                <td class="p-5 text-right">
                                    <a href="{{ route('quotes.download', $quote->id) }}"
                                        class="inline-flex items-center justify-center w-9 h-9 border border-slate-200 text-slate-600 rounded-lg hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all shadow-sm tooltip"
                                        title="Download Document">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="py-24 text-center">
                <div
                    class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-100 mb-6 border-8 border-white shadow-sm">
                    <i class="fa-regular fa-folder-open text-3xl text-slate-300"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">No quotes found</h3>
                <p class="text-slate-500 mb-6 max-w-sm mx-auto">You haven't generated any proposals yet. Start by creating a new
                    quote.</p>
                <a href="{{ route('quotes.create') }}"
                    class="text-brand-600 font-semibold hover:text-brand-700 underline underline-offset-4">Create your first
                    quote</a>
            </div>
        @endif
    </div>
@endsection