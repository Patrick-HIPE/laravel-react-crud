<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
    // List products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    // Create product
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    // Update product
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}/edit', [ProductController::class, 'update'])->name('products.update');
    // Delete product
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
