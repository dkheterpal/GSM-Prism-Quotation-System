<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;

Route::get('/', function () {
    return redirect()->route('quotes.index');
});

Route::get('/quotes', [QuoteController::class, 'index'])->name('quotes.index');
Route::get('/quotes/create', [QuoteController::class, 'create'])->name('quotes.create');
Route::post('/quotes', [QuoteController::class, 'store'])->name('quotes.store');
Route::get('/quotes/{id}/download', [QuoteController::class, 'download'])->name('quotes.download');

Route::get('/api/products', [QuoteController::class, 'apiProducts']);
Route::get('/api/products/{id}/prices', [QuoteController::class, 'apiPrices']);

