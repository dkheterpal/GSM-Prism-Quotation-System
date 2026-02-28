@extends('layouts.app')
@section('title', 'Quotes Dashboard')

@section('content')
    <div class="flex justify-between items-end mb-8 animate-fade-in" style="animation-delay: 0.1s;">
        <div>
            <h2 class="text-3xl font-bold tracking-tight text-slate-900 border-b-4 border-slate-900 pb-2 inline-block">
                Quotes Dashboard</h2>
            <p class="text-slate-500 mt-3 text-sm font-medium">Manage and generate customer proposals</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-4 mt-6 sm:mt-0">
            <form action="{{ route('quotes.index') }}" method="GET" class="relative">
                <input type="hidden" name="status" value="{{ $currentStatus }}">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search quotes..."
                    class="w-full sm:w-64 pl-10 pr-20 py-2 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 bg-white text-sm transition-all focus:w-full sm:focus:w-80">
                <i class="fa-solid fa-search absolute left-3 top-2.5 text-slate-400"></i>
                <button type="submit"
                    class="absolute right-1 top-1 text-xs bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-1.5 px-3 rounded shadow-sm border border-slate-200 transition-colors">
                    Search
                </button>
                @if(request('search'))
                    <a href="{{ route('quotes.index', ['status' => $currentStatus]) }}"
                        class="absolute -right-8 top-2.5 text-slate-400 hover:text-red-500" title="Clear Search">
                        <i class="fa-solid fa-times"></i>
                    </a>
                @endif
            </form>
            <a href="{{ route('quotes.create') }}"
                class="bg-slate-900 hover:bg-slate-800 text-white font-semibold py-2.5 px-6 rounded-lg shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                <i class="fa-solid fa-plus-circle"></i> Create New Quote
            </a>
        </div>
    </div>

    <!-- Status Tabs -->
    <div class="mb-6 border-b border-slate-200 animate-fade-in" style="animation-delay: 0.15s;">
        <nav class="-mb-px flex space-x-6" aria-label="Tabs">
            <a href="{{ route('quotes.index', ['status' => 'Active']) }}"
                class="{{ $currentStatus == 'Active' || $currentStatus == 'active' ? 'border-brand-500 text-brand-600' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700' }} whitespace-nowrap border-b-2 py-3 px-1 text-sm font-medium transition-colors">
                <i class="fa-solid fa-circle-check mr-2"></i>Active
            </a>
            <a href="{{ route('quotes.index', ['status' => 'all']) }}"
                class="{{ $currentStatus == 'all' ? 'border-brand-500 text-brand-600' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700' }} whitespace-nowrap border-b-2 py-3 px-1 text-sm font-medium transition-colors">
                <i class="fa-solid fa-layer-group mr-2"></i>All
            </a>
            <a href="{{ route('quotes.index', ['status' => 'deleted']) }}"
                class="{{ $currentStatus == 'deleted' ? 'border-red-500 text-red-600' : 'border-transparent text-slate-500 hover:border-red-300 hover:text-red-700' }} whitespace-nowrap border-b-2 py-3 px-1 text-sm font-medium transition-colors">
                <i class="fa-solid fa-trash mr-2"></i>Deleted
            </a>
        </nav>
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
                                    <a href="{{ route('quotes.show', $quote->id) }}"
                                        class="hover:text-slate-600 hover:underline">{{ $quote->quote_number }}</a>
                                </td>
                                <td class="p-5">
                                    <div class="flex items-center gap-3">
                                        @if($quote->company_logo)
                                            <div
                                                class="w-10 h-10 rounded border border-slate-200 bg-white flex items-center justify-center p-1 overflow-hidden shrink-0">
                                                <img src="{{ url($quote->company_logo) }}" class="max-w-full max-h-full object-contain"
                                                    alt="Logo">
                                            </div>
                                        @else
                                            <div
                                                class="w-10 h-10 rounded border border-slate-200 bg-slate-100 flex items-center justify-center shrink-0 text-slate-400 font-bold">
                                                {{ strtoupper(substr($quote->company_name ?: $quote->customer_name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-semibold text-slate-800">
                                                {{ $quote->company_name ?: $quote->customer_name }}
                                            </div>
                                            <div class="text-slate-500 text-xs mt-1">
                                                {{ $quote->company_name ? 'c/o ' . $quote->customer_name : '' }}
                                                @if($quote->email)
                                                    <span
                                                        class="inline-block {{ $quote->company_name ? 'ml-2 border-l border-slate-300 pl-2' : '' }}"><i
                                                            class="fa-regular fa-envelope mr-1"></i>{{ $quote->email }}</span>
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
                                            <span
                                                class="text-[10px] bg-slate-50 border border-slate-200 text-slate-500 px-1.5 py-0.5 rounded truncate max-w-[120px]"
                                                title="{{ $item->product->name }}">{{ $item->product->name }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="p-5 relative">
                                    @php
                                        $statusClass = 'bg-slate-100 text-slate-600 border-slate-200';
                                        $statusStr = strtolower($quote->status);
                                        if ($statusStr === 'active')
                                            $statusClass = 'bg-emerald-50 text-emerald-600 border-emerald-200';
                                        elseif ($statusStr === 'sent')
                                            $statusClass = 'bg-blue-50 text-blue-600 border-blue-200';
                                        elseif ($statusStr === 'accepted')
                                            $statusClass = 'bg-green-50 text-green-700 border-green-200';
                                        elseif ($statusStr === 'rejected')
                                            $statusClass = 'bg-red-50 text-red-600 border-red-200';
                                        if ($quote->trashed())
                                            $statusClass = 'bg-slate-100 text-slate-500 border-slate-200 line-through';
                                    @endphp

                                    @if($quote->trashed())
                                        <span
                                            class="capitalize {{ $statusClass }} border rounded-full px-3 py-1 text-xs font-bold tracking-wide shadow-sm flex items-center w-fit">
                                            <i class="fa-solid fa-trash-can text-[8px] mr-1 mb-[1px]"></i>Deleted
                                        </span>
                                    @else
                                        <form action="{{ route('quotes.updateStatus', $quote->id) }}" method="POST"
                                            class="inline-block relative">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.requestSubmit()"
                                                class="capitalize {{ $statusClass }} border rounded-full pl-3 pr-7 py-1 text-xs font-bold tracking-wide shadow-sm appearance-none outline-none cursor-pointer focus:ring-2 focus:ring-brand-500 transition-all">
                                                <option value="Active" {{ $statusStr === 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="Sent" {{ $statusStr === 'sent' ? 'selected' : '' }}>Sent</option>
                                                <option value="Accepted" {{ $statusStr === 'accepted' ? 'selected' : '' }}>Accepted
                                                </option>
                                                <option value="Rejected" {{ $statusStr === 'rejected' ? 'selected' : '' }}>Rejected
                                                </option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                                <i class="fa-solid fa-chevron-down text-[10px] text-slate-500"></i>
                                            </div>
                                        </form>
                                    @endif

                                    <div class="mt-3 group/notes relative w-48">
                                        <form action="{{ route('quotes.updateNotes', $quote->id) }}" method="POST"
                                            class="flex items-start gap-1">
                                            @csrf
                                            @method('PATCH')
                                            <div class="flex-grow">
                                                <div class="text-[10px] font-bold text-slate-400 mb-0.5 uppercase tracking-wider"><i
                                                        class="fa-solid fa-lock text-[8px] mr-1"></i>Internal Notes</div>
                                                <textarea name="notes" rows="1"
                                                    class="w-full text-xs text-slate-600 bg-slate-50 border border-transparent hover:border-slate-200 focus:border-brand-500 focus:bg-white rounded p-1.5 resize-none transition-all outline-none"
                                                    placeholder="Add a private note...">{{ $quote->notes }}</textarea>
                                            </div>
                                            <button type="submit"
                                                class="mt-4 text-slate-400 hover:text-brand-600 p-1 rounded hover:bg-slate-100 transition-colors opacity-0 group-hover/notes:opacity-100"
                                                title="Save Note">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="p-5 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('quotes.show', $quote->id) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 border border-slate-200 text-slate-600 rounded-lg hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all shadow-sm tooltip"
                                            title="View Quote">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        @if(!$quote->trashed())
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

                                            <form id="delete-form-{{ $quote->id }}" action="{{ route('quotes.destroy', $quote->id) }}"
                                                method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button type="button" onclick="confirmDelete({{ $quote->id }})"
                                                class="inline-flex items-center justify-center w-9 h-9 border border-slate-200 text-slate-600 rounded-lg hover:bg-red-600 hover:text-white hover:border-red-600 transition-all shadow-sm tooltip"
                                                title="Delete Quote">
                                                <i class="fa-solid fa-trash pointer-events-none"></i>
                                            </button>
                                        @else
                                            <form id="restore-form-{{ $quote->id }}" action="{{ route('quotes.restore', $quote->id) }}"
                                                method="POST" class="hidden">
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                            <button type="button" onclick="confirmRestore({{ $quote->id }})"
                                                class="inline-flex items-center justify-center px-4 h-9 border border-emerald-200 text-emerald-700 bg-emerald-50 rounded-lg hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition-all shadow-sm tooltip font-semibold text-sm gap-2"
                                                title="Restore Quote">
                                                <i class="fa-solid fa-rotate-left pointer-events-none"></i> Restore
                                            </button>
                                        @endif
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