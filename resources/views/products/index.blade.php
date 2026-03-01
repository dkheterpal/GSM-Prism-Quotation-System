@extends('layouts.app')
@section('title', 'Products Management')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-8 animate-fade-in" style="animation-delay: 0.1s;">
        <div class="w-full md:w-auto">
            <h2 class="text-3xl font-bold tracking-tight text-slate-900 border-b-4 border-slate-900 pb-2 inline-block">
                Products Dashboard</h2>
            <p class="text-slate-500 mt-3 text-sm font-medium">Manage products and pricing</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-4 mt-6 sm:mt-0 w-full md:w-auto">
            <form action="{{ route('products.index') }}" method="GET" class="relative w-full sm:w-auto">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="w-full sm:w-64 pl-10 pr-20 py-2.5 sm:py-2 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 bg-white text-sm transition-all focus:w-full sm:focus:w-80">
                <i class="fa-solid fa-search absolute left-3 top-2.5 text-slate-400"></i>
                <button type="submit" class="absolute right-1 top-1 text-xs bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-1.5 px-3 rounded shadow-sm border border-slate-200 transition-colors">
                    Search
                </button>
                @if(request('search'))
                    <a href="{{ route('products.index') }}" class="absolute -right-8 top-2.5 text-slate-400 hover:text-red-500" title="Clear Search">
                        <i class="fa-solid fa-times"></i>
                    </a>
                @endif
            </form>
            <a href="{{ route('products.create') }}"
                class="bg-slate-900 hover:bg-slate-800 text-white font-semibold py-2.5 px-6 rounded-lg shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2 w-full sm:w-auto">
                <i class="fa-solid fa-plus-circle"></i> Add New Product
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden animate-fade-in"
        style="animation-delay: 0.2s;">
        @if(count($products) > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 font-semibold text-sm">
                            <th class="p-5 font-semibold text-slate-700">Image</th>
                            <th class="p-5 font-semibold text-slate-700">Name</th>
                            <th class="p-5 font-semibold text-slate-700">Prices</th>
                            <th class="p-5 font-semibold text-slate-700 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @foreach($products as $product)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="p-5">
                                    @if($product->image_path)
                                        <div class="w-16 h-16 rounded border border-slate-200 bg-white flex items-center justify-center p-1 overflow-hidden shrink-0">
                                            <img src="{{ url($product->image_path) }}" class="max-w-full max-h-full object-contain" alt="Logo">
                                        </div>
                                    @else
                                        <div class="w-16 h-16 rounded border border-slate-200 bg-slate-100 flex items-center justify-center shrink-0 text-slate-400">
                                            <i class="fa-solid fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="p-5 font-semibold text-slate-900">{{ $product->name }}</td>
                                <td class="p-5">
                                    <div class="flex flex-col gap-1">
                                        @foreach($product->prices as $price)
                                            <span class="inline-block text-xs font-semibold bg-slate-100 border border-slate-200 text-slate-700 px-2 py-1 rounded">
                                                {{ $price->type }} - Setup: ${{ number_format($price->setup_fee, 0) }}
                                                @if($price->monthly_fee > 0)
                                                 | Mo: ${{ number_format($price->monthly_fee, 0) }} 
                                                 @if($price->term_months)
                                                    x {{ $price->term_months }}mo
                                                 @endif
                                                @endif
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="p-5 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 border border-slate-200 text-slate-600 rounded-lg hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all shadow-sm tooltip"
                                            title="Edit Product">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>

                                        <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="button"
                                            onclick="confirmDelete({{ $product->id }})"
                                            class="inline-flex items-center justify-center w-9 h-9 border border-slate-200 text-slate-600 rounded-lg hover:bg-red-600 hover:text-white hover:border-red-600 transition-all shadow-sm tooltip"
                                            title="Delete Product">
                                            <i class="fa-solid fa-trash pointer-events-none"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($products->hasPages())
                <div class="p-5 border-t border-slate-100 bg-slate-50/50">
                    {{ $products->links() }}
                </div>
            @endif
        @else
            <div class="py-24 text-center">
                <div
                    class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-100 mb-6 border-8 border-white shadow-sm">
                    <i class="fa-solid fa-box-open text-3xl text-slate-300"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">No products found</h3>
                <p class="text-slate-500 mb-6 max-w-sm mx-auto">Start by adding your first product to the database.</p>
                <a href="{{ route('products.create') }}"
                    class="text-slate-900 font-semibold hover:text-slate-700 underline underline-offset-4">Add your first product</a>
            </div>
        @endif
    </div>
@endsection
