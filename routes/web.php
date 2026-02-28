<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;

Route::get('/', function () {
    return redirect()->route('quotes.index');
});

Route::get('/quotes', [QuoteController::class, 'index'])->name('quotes.index');
Route::get('/quotes/create', [QuoteController::class, 'create'])->name('quotes.create');
Route::post('/quotes', [QuoteController::class, 'store'])->name('quotes.store');
Route::get('/quotes/{id}', [QuoteController::class, 'show'])->name('quotes.show');
Route::get('/quotes/{id}/edit', [QuoteController::class, 'edit'])->name('quotes.edit');
Route::put('/quotes/{id}', [QuoteController::class, 'update'])->name('quotes.update');
Route::delete('/quotes/{id}', [QuoteController::class, 'destroy'])->name('quotes.destroy');
Route::patch('/quotes/{id}/restore', [QuoteController::class, 'restore'])->name('quotes.restore');
Route::get('/quotes/{id}/download', [App\Http\Controllers\QuotePdfController::class, 'download'])->name('quotes.download');

Route::resource('/products', App\Http\Controllers\ProductController::class);

Route::get('/api/products', [QuoteController::class, 'apiProducts']);
Route::get('/api/products/{id}/prices', [QuoteController::class, 'apiPrices']);

