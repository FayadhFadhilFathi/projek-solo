<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Rute untuk produk (menggunakan resource untuk CRUD)
Route::resource('products', ProductController::class);

// Tambahkan route resource untuk OrderItem
Route::resource('order-items', OrderItemController::class);

// Rute untuk login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Rute untuk register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Rute untuk logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');