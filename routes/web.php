<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::prefix('/products')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/show/{id}', 'show');
    Route::get('/create', 'create');
    Route::get('/edit', 'edit');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // Menampilkan daftar produk
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // Menampilkan form tambah produk
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store'); // Menyimpan produk
