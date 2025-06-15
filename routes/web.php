<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DownloadController; // TAMBAHKAN INI
use App\Http\Middleware\AdminMiddleware;
use App\Models\Product;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\HomeController;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes that require authentication
Route::middleware([Authenticate::class])->group(function () {
    // Admin routes
    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/product', [ProductController::class, 'store'])->name('product.store');

        // Add the edit route
        Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');

        // Add the update route
        Route::put('/product/{product}', [ProductController::class, 'update'])->name('product.update');

        // Add the delete confirmation route
        Route::get('/product/{id}/delete', [ProductController::class, 'delete'])->name('product.delete');

        // The destroy route for deleting a product
        Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

        // Admin dashboard route
        Route::get('/admin/dashboard', function () {
            $users = \App\Models\User::all();
            return view('admin.dashboard', compact('users'));
        })->name('admin.dashboard');

        // User management routes
        Route::resource('users', UserController::class);
    });

    // User order routes
    Route::prefix('user/order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('user.order.index');
        Route::get('/checkout', [OrderController::class, 'checkout'])->name('user.order.checkout');
        Route::post('/payment/process', [OrderController::class, 'processPayment'])->name('user.payment.process');
        Route::get('/history', [OrderController::class, 'history'])->name('user.order.history');
        Route::post('/', [OrderController::class, 'store'])->name('user.order.store');

        // New remove routes
        Route::delete('/{id}/remove', [OrderController::class, 'remove'])->name('user.order.remove');
        Route::post('/remove-bulk', [OrderController::class, 'removeBulk'])->name('user.order.remove.bulk');
    });

    // CRUD routes for order items
    Route::resource('order-items', OrderItemController::class);

    // User dashboard route
    Route::get('/dashboard', function () {
        $products = Product::all();
        return view('user.dashboard', compact('products'));
    })->name('dashboard');
    
    // TAMBAHKAN ROUTE DOWNLOAD DI SINI
    Route::get('/download/{order}', [DownloadController::class, 'download'])
         ->name('download.file');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');