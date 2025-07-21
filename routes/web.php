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
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminReviewController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TypeController;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Public product show route (MUST be public)
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public category routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{category}/type/{type}', [CategoryController::class, 'type'])
     ->name('categories.type');

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
            return view('admin.dashboard');
        })->name('admin.dashboard');
        // Add this with the other admin routes
        Route::get('/admin/categories', [CategoryController::class, 'adminIndex'])
            ->name('admin.categories.index');

        // API route to get types by category
        Route::get('/api/categories/{category}/types', [ProductController::class, 'getTypesByCategory'])
     ->name('api.categories.types');

        // Type management routes
        Route::prefix('categories/{category}/types')->group(function () {
            Route::get('/', [TypeController::class, 'index'])->name('categories.types.index');
            Route::get('/create', [TypeController::class, 'create'])->name('categories.types.create');
            Route::post('/', [TypeController::class, 'store'])->name('categories.types.store');
            Route::get('/{type}/edit', [TypeController::class, 'edit'])->name('categories.types.edit');
            Route::put('/{type}', [TypeController::class, 'update'])->name('categories.types.update');
            Route::delete('/{type}', [TypeController::class, 'destroy'])->name('categories.types.destroy');
        });
        // User management
        Route::resource('users', UserController::class);

        // Review management
        Route::get('/reviews', [AdminReviewController::class, 'index'])->name('admin.reviews.index');
        Route::put('/reviews/{review}', [AdminReviewController::class, 'update'])->name('admin.reviews.update');

        // Analytics dashboard
        Route::get('/analytics', [AnalyticsController::class, 'dashboard'])->name('admin.analytics.dashboard');

        // Admin category management routes
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
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

        // User review routes
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