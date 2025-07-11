<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DownloadController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Product;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController; // Tambahkan ini
use App\Http\Controllers\AdminReviewController; // Tambahkan ini
use App\Http\Controllers\AnalyticsController; // Tambahkan ini

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes that require authentication
Route::middleware([Authenticate::class])->group(function () {
    // Admin routes
    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/product', [ProductController::class, 'store'])->name('product.store');
        Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/product/{product}', [ProductController::class, 'update'])->name('product.update');
        Route::get('/product/{id}/delete', [ProductController::class, 'delete'])->name('product.delete');
        Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
        Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

        // Admin download route
        Route::get('/products/{product}/download', [ProductController::class, 'download'])
             ->name('products.download');

        // Admin dashboard
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard'); // Hanya tampilkan dashboard navigasi
        })->name('admin.dashboard');

        // User management
        Route::resource('users', UserController::class);

        // Review management
        Route::get('/reviews', [AdminReviewController::class, 'index'])->name('admin.reviews.index');
        Route::put('/reviews/{review}', [AdminReviewController::class, 'update'])->name('admin.reviews.update');
        
        // Analytics dashboard
        Route::get('/analytics', [AnalyticsController::class, 'dashboard'])->name('admin.analytics.dashboard');
    });

    // User order routes
    Route::prefix('user/order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('user.order.index');
        Route::get('/checkout', [OrderController::class, 'checkout'])->name('user.order.checkout');
        Route::post('/payment/process', [OrderController::class, 'processPayment'])->name('user.payment.process');
        Route::get('/history', [OrderController::class, 'history'])->name('user.order.history');
        Route::post('/', [OrderController::class, 'store'])->name('user.order.store');
        Route::delete('/{id}/remove', [OrderController::class, 'remove'])->name('user.order.remove');
        Route::post('/remove-bulk', [OrderController::class, 'removeBulk'])->name('user.order.remove.bulk');
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
        
        // User review routes - tambahkan di sini
        Route::post('/{order}/review', [ReviewController::class, 'store'])->name('user.review.store');
    });

    // User download route
    Route::get('/download/{order}', [DownloadController::class, 'download'])
         ->name('download.file');

    // Order items
    Route::resource('order-items', OrderItemController::class);

    // User dashboard
    Route::get('/dashboard', function () {
        $products = Product::all();
        return view('user.dashboard', compact('products'));
    })->name('dashboard');
});