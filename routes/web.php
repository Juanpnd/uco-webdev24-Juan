<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Product1Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/products/tshirts', [ProductController::class, 'tshirts'])->name('products.tshirts');
Route::get('/products/shoes', [ProductController::class, 'shoes'])->name('products.shoes');
Route::get('/products/shorts', [ProductController::class, 'shorts'])->name('products.shorts');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/filter', [ProductController::class, 'filter'])->name('products.filter');
Route::get('/products/{id}', [HomeController::class, 'show'])->name('products.show');

Route::middleware(['auth'])->group(function () {
	Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
	Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
	Route::post('/cart/remove', [CartController::class, 'destroy'])->name('cart.destroy');
	Route::get('/', [ProductController::class, 'index'])->name('products.list');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products1.create');

    Route::get('/wishlist', [ProductController::class, 'wishlist'])->name('wishlist.index');
    Route::post('/wishlist/{id}', [ProductController::class, 'toggleWishlist'])->name('wishlist.toggle');
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
// Logout route

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home.index'); // Ganti 'home.index' dengan nama route yang sesuai
})->name('logout');


// Rute untuk register, jika diperlukan
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');  // Hanya dapat diakses oleh pengguna yang sudah login

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});

Route::get('/order/success/{order}', function ($order) {
    return view('order.success', compact('order'));
})->name('order.success');

Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
	Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

Route::prefix('/products')->controller(ProductController::class)->group(function() {
	Route::get('/', 'index')->name('products.list');
	Route::post('/store', 'store')->name('products.store');
	Route::get('/edit/{id}', 'edit')->name('products.edit');
	Route::post('/update/{id}', 'update')->name('products.update');
	Route::delete('/destroy/{id}', 'destroy')->name('products.destroy');
	Route::get('/show/{id}', 'show')->name('products.show');
});

Route::get('product/{id}/share', [ProductController::class, 'share'])->name('share');

Route::get('/products', [ProductController::class, 'index'])->name('products.list');
Route::delete('products/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/{product}/add-stock', [ProductController::class, 'showAddStockForm'])->name('products.add-stock');
Route::post('/products/{product}/add-stock', [ProductController::class, 'addStock'])->name('products.add-stock.submit');

Route::get('products1/index', [Product1Controller::class, 'index'])->name('products1.index');
Route::get('/products1/create', [Product1Controller::class, 'create'])->name('products1.create');
Route::post('products1/store', [Product1Controller::class, 'store'])->name('products1.store');
Route::get('products1/edit/{id}', [Product1Controller::class, 'edit'])->name('products1.edit');
Route::post('products1/update/{id}', [Product1Controller::class, 'update'])->name('products1.update');
Route::delete('products1/destroy/{id}', [Product1Controller::class, 'destroy'])->name('products1.destroy');
Route::get('products1/show/{id}', [Product1Controller::class, 'show'])->name('products1.show');
Route::get('/products/tshirts', [ProductController::class, 'tshirts'])->name('products.tshirts');