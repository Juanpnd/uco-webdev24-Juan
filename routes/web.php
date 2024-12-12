<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/products/tshirts', [ProductController::class, 'tshirts'])->name('products.tshirts');
Route::get('/products/shoes', [ProductController::class, 'shoes'])->name('products.shoes');
Route::get('/products/shorts', [ProductController::class, 'shorts'])->name('products.shorts');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/filter', [ProductController::class, 'filter'])->name('products.filter');


Route::prefix('/products')->controller(ProductController::class)->group(function() {
	Route::get('/', 'index')->name('products.list');
	Route::get('/create', 'create')->name('products.create');
	Route::post('/store', 'store')->name('products.store');
	Route::get('/edit/{id}', 'edit')->name('products.edit');
	Route::post('/update/{id}', 'update')->name('products.update');
	Route::post('/destroy/{id}', 'destroy')->name('products.destroy');
	Route::get('/show/{id}', 'show')->name('products.show');
});

