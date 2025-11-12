<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('/allProduct', [ProductController::class, 'all_product']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(OrderController::class)->group(function () {
        Route::post('/createOrder', 'create');
    });
    Route::prefix('dashboard')->group(function () {
        Route::get('', function (Request $request) {
            return Inertia::render('Dashboard', ['user' => $request->user()]);
        })->name('dashboard');
        Route::prefix('/seller')->group(function () {
            Route::controller(ProductController::class)->group(function () {
                Route::get('/createProduct', 'create');
                Route::post('/createProduct', 'store')->name('storeProduct');
                Route::get('/productOfUserSeller', 'product_by_id_seller');
                Route::delete('/deleteProduct/{id}', 'destroy');
                Route::get('/editProduct/{id}', 'edit');
                Route::put('/editProduct/{id}', 'update');
            });
        });
    });
});

require __DIR__.'/settings.php';
