<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\AuthController;
use App\Models\Product;

// ✅ Halaman home (umum)
Route::get('/', function () {
    return view('home');
})->name('home');


// ✅ Rute yang hanya bisa diakses jika sudah login
    Route::middleware('auth')->group(function () {
    // Rute CRUD produk hanya bisa diakses oleh admin

    Route::get('/products', [ProductController::class, 'showIndexProducts']);
    

    // Rute CRUD order item
    Route::resource('order-items', OrderItemController::class);

    // Rute checkout
    Route::get('/checkout', function () {
        return view('checkout');
    })->name('checkout');

    // Rute logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ✅ Route user dashboard
    Route::get('/dashboard', function () {
        $products = \App\Models\Product::all(); // ✅ fetch all products
        return view('user.dashboard', compact('products'));
    })->middleware('auth')->name('dashboard');

});

// ✅ Rute login & register (boleh diakses tanpa login)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
