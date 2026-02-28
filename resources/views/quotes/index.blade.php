@extends('layouts.app')
@section('title', 'Quotes Dashboard')

@section('content')
    <div class="flex justify-between items-end mb-8 animate-fade-in" style="animation-delay: 0.1s;">
        <div>
            <h2 class="text-3xl font-bold tracking-tight text-slate-900 border-b-4 border-slate-900 pb-2 inline-block">
                Quotes Dashboard</h2>
            <p class="text-slate-500 mt-3 text-sm font-medium">Manage and generate customer proposals</p>
        </div>
        <a href="{{ route('quotes.create') }}"
            class="bg-slate-900 hover:bg-slate-800 text-white font-semibold py-2.5 px-6 rounded-lg shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center gap-2">
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
                                <td class="p-5 font-mono font-semibold text-slate-900">
                                    <a href="{{ route('quotes.show', $quote->id) }}" class="hover:text-slate-600 hover:underline">{{ $quote->quote_number }}</a>
                                </td>
                                <td class="p-5">
                                    <div class="flex items-center gap-3">
                                        @if($quote->company_logo)
                                            <div class="w-10 h-10 rounded border border-slate-200 bg-white flex items-center justify-center p-1 overflow-hidden shrink-0">
                                                <img src="{{ url($quote->company_logo) }}" class="max-w-full max-h-full object-contain" alt="Logo">
                                            </div>
                                        @else
                                            <div class="w-10 h-10 rounded border border-slate-200 bg-slate-100 flex items-center justify-center shrink-0 text-slate-400 font-bold">
                                                {{ strtoupper(substr($quote->company_name ?: $quote->customer_name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-semibold text-slate-800">{{ $quote->company_name ?: $quote->customer_name }}</div>
                                            <div class="text-slate-500 text-xs mt-1">
                                                {{ $quote->company_name ? 'c/o ' . $quote->customer_name : '' }}
                                                @if($quote->email)
                                                    <span class="inline-block {{ $quote->company_name ? 'ml-2 border-l border-slate-300 pl-2' : '' }}"><i class="fa-regular fa-envelope mr-1"></i>{{ $quote->email }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-5 text-slate-600">{{ $quote->created_at->format('M j, Y') }}<br><span
                                        class="text-xs text-slate-400">{{ $quote->created_at->format('g:i A') }}</span></td>
                                <td class="p-5">
                                    <span
                                        class="bg-slate-100 text-slate-800 border border-slate-200 font-bold py-1 px-3 rounded-full text-xs shadow-sm">
                                        {{ $quote->items->count() }}
                                    </span>
                                    <div class="mt-2 flex flex-wrap gap-1 max-w-[200px]">
                                        @foreach($quote->items as $item)
                                            <span class="text-[10px] bg-slate-50 border border-slate-200 text-slate-500 px-1.5 py-0.5 rounded truncate max-w-[120px]" title="{{ $item->product->name }}">{{ $item->product->name }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="p-5">
                                    <span
                                        class="capitalize bg-amber-50 text-amber-600 border border-amber-200 rounded-full px-3 py-1 text-xs font-bold tracking-wide shadow-sm">
                                        <i class="fa-solid fa-circle-dot text-[8px] mr-1 mb-[1px]"></i>{{ $quote->status }}
                                    </span>
                                </td>
                                <td class="p-5 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('quotes.show', $quote->id) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 border border-slate-200 text-slate-600 rounded-lg hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all shadow-sm tooltip"
                                            title="View Quote">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <a href="{{ route('quotes.edit', $quote->id) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 border border-slate-200 text-slate-600 rounded-lg hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all shadow-sm tooltip"
                                            title="Edit Quote">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>

                                        <a href="{{ route('quotes.download', $quote->id) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 border border-slate-200 text-slate-600 rounded-lg hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all shadow-sm tooltip"
                                            title="Download Document">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </a>

                                        <form action="{{ route('quotes.destroy', $quote->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this quote?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-9 h-9 border border-slate-200 text-slate-600 rounded-lg hover:bg-red-600 hover:text-white hover:border-red-600 transition-all shadow-sm tooltip"
                                                title="Delete Quote">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($quotes->hasPages())
                <div class="p-5 border-t border-slate-100 bg-slate-50/50">
                    {{ $quotes->links() }}
                </div>
            @endif
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
                    class="text-slate-900 font-semibold hover:text-slate-700 underline underline-offset-4">Create your first
                    quote</a>
            </div>
        @endif
    </div>
@endsection