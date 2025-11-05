<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');
        Route::prefix('/seller')->group(function (){
            Route::controller(ProductController::class)->group(function (){
                Route::get("/createProduct","create");
                Route::post('/createProduct',"store")->name("storeProduct");
                Route::get("/productOfUserSeller","product_by_id_seller");
            });
        });
    });
});

require __DIR__.'/settings.php';
