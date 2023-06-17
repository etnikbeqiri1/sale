<?php

use App\Http\Controllers\StatsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemPricingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PriceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/prices', [PriceController::class, 'index'])->name('prices.index');
    Route::get('/prices/create', [PriceController::class, 'create'])->name('prices.create');
    Route::post('/prices', [PriceController::class, 'store'])->name('prices.store');
    Route::get('/prices/{id}', [PriceController::class, 'show'])->name('prices.show');
    Route::get('/prices/{id}/edit', [PriceController::class, 'edit'])->name('prices.edit');
    Route::put('/prices/{id}', [PriceController::class, 'update'])->name('prices.update');
    Route::delete('/prices/{id}', [PriceController::class, 'destroy'])->name('prices.destroy');
    Route::get('/prices/item/{id}', [PriceController::class, 'getPricesFromItem'])->name('prices.getPricesFromItem');

    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{id}', [ItemController::class, 'show'])->name('items.show');
    Route::get('/items/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{id}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');

    Route::get('/item_pricings', [ItemPricingController::class, 'index'])->name('item_pricings.index');
    Route::get('/item_pricings/create', [ItemPricingController::class, 'create'])->name('item_pricings.create');
    Route::post('/item_pricings', [ItemPricingController::class, 'store'])->name('item_pricings.store');
    Route::get('/item_pricings/{id}', [ItemPricingController::class, 'show'])->name('item_pricings.show');
    Route::get('/item_pricings/{id}/edit', [ItemPricingController::class, 'edit'])->name('item_pricings.edit');
    Route::put('/item_pricings/{id}', [ItemPricingController::class, 'update'])->name('item_pricings.update');
    Route::delete('/item_pricings/{id}', [ItemPricingController::class, 'destroy'])->name('item_pricings.destroy');


    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');


    Route::get('/session/create', [SessionController::class, 'create'])->name('sessions.create');
    Route::post('/session', [SessionController::class, 'store'])->name('sessions.store');
    Route::get('/active-sessions', [SessionController::class, 'getActiveSessions'])->name('sessions.active');
    Route::get('/session/{id}/stop', [SessionController::class, 'stop'])->name('sessions.stop');
    Route::put('/session/{id}/stop', [SessionController::class, 'stopSession'])->name('sessions.stopSession');
    Route::post('/sessions/{sessionId}/products', [SessionController::class, 'addProductToSession']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/stats', [StatsController::class, 'index'])->name('stats');


});





