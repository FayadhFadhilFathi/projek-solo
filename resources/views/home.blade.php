@extends('layouts.app')

@section('main-class', '')
@section('main-spacing', '')

@section('content')
<div class="w-100">
    <!-- Hero Section - Full Screen -->
    <div class="hero-gradient text-white min-vh-100 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center hero-content">
                    <div class="mb-4">
                        <h1 class="display-1 fw-bold text-primary-custom mb-3">VOIDGame</h1>
                        <div class="hero-icon mb-4">
                            <i class="bi bi-android2 display-2 text-warning"></i>
                            <i class="bi bi-xbox display-2 text-info mx-3"></i>
                            <i class="bi bi-steam display-2 text-success"></i>
                        </div>
                    </div>
                    <h2 class="display-4 fw-bold mb-3 text-light">RANCANG RUANG PROJECT</h2>
                    <h3 class="h2 mb-4 text-warning">GAME COMPETITIF</h3>
                    <p class="lead mb-2 text-light">Your One-Stop Shop for All Your Game Needs</p>
                    <p class="mb-5 fs-5 text-light-emphasis">Explore premium game and console for professional results!</p>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-warning btn-lg px-5 py-3 shadow-lg">
                            <i class="bi bi-shop me-2"></i>Shop Now
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-warning btn-lg px-5 py-3 shadow-lg">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Shop Now
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="container">
        <div class="row py-5">
            <div class="col-12 text-center">
                <h2 class="display-5 fw-bold text-primary mb-3">Selamat Datang di VOIDGame</h2>
                <p class="lead text-muted">Kami menyediakan berbagai Game dan Console berkualitas tinggi untuk kebutuhan Anda!</p>
            </div>
        </div>

        <!-- Products Section -->
        <div class="row">
            @forelse ($products as $product)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <!-- Product Image -->
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            @if ($product->image)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid rounded-top" style="max-height: 200px; width: 100%; object-fit: cover;">
                            @else
                                <div class="text-center text-muted">
                                    <i class="bi bi-image display-1"></i>
                                    <p class="mb-0 small">No Image Available</p>
                                </div>
                            @endif
                        </div>

                        <!-- Product Details -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark">{{ $product->name }}</h5>

                            @if($product->description)
                                <p class="card-text text-muted small mb-3">
                                    {{ Str::limit($product->description, 100) }}
                                </p>
                            @else
                                <p class="card-text text-muted small mb-3">No description available</p>
                            @endif

                            <!-- Price and Stock -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-success fs-6 px-3 py-2">
                                        <i class="bi bi-currency-dollar me-1"></i>${{ number_format($product->price, 2) }}
                                    </span>
                                    @if($product->stock > 0)
                                        <span class="badge bg-primary px-3 py-2">
                                            <i class="bi bi-box me-1"></i>{{ $product->stock }} in stock
                                        </span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2">
                                            <i class="bi bi-x-circle me-1"></i>Out of stock
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-auto">
                                <div class="d-grid gap-2">
                                    @auth
                                        <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                            <i class="bi bi-cart-plus me-2"></i>Beli Sekarang
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary">
                                            <i class="bi bi-box-arrow-in-right me-2"></i>Beli Sekarang
                                        </a>
                                    @endauth
                                    <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#productModal{{ $product->id }}">
                                        <i class="bi bi-info-circle me-2"></i>Lihat Info
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Info Modal -->
                <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $product->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if ($product->image)
                                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid rounded">
                                        @else
                                            <div class="bg-light text-center p-5 rounded">
                                                <i class="bi bi-image display-1 text-muted"></i>
                                                <p class="text-muted">No Image Available</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="fw-bold">Product Details</h5>
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>Price:</strong></td>
                                                <td>${{ number_format($product->price, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Stock:</strong></td>
                                                <td>{{ $product->stock }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Description:</strong></td>
                                                <td>{{ $product->description ?? 'No description available' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                @auth
                                    <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                        <i class="bi bi-cart-plus me-2"></i>Buy Now
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>Login to Buy
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="bi bi-box-seam display-1 text-muted mb-3"></i>
                        <h3 class="text-muted">No Products Available</h3>
                        <p class="text-muted">Check back soon for new products!</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
/* Hero Section with Beautiful Gradient */
.hero-gradient {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 25%, #3d7eaa 50%, #50a3a2 75%, #63c8a0 100%);
    position: relative;
    overflow: hidden;
}

.hero-gradient::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 30% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 70% 80%, rgba(255, 215, 0, 0.1) 0%, transparent 50%);
}

.hero-gradient > * {
    position: relative;
    z-index: 1;
}

.text-primary-custom {
    color: #FFD700 !important;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    letter-spacing: 3px;
}

.text-light-emphasis {
    color: rgba(255, 255, 255, 0.9) !important;
}

.hero-icon {
    animation: float 3s ease-in-out infinite;
}

.hero-content {
    animation: fadeInUp 1.2s ease-out;
}

/* Floating animation for icons */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

/* Enhanced fade-in animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Button hover effects */
.btn-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4) !important;
    transition: all 0.3s ease;
}

/* Ensure no body margins interfere with full-screen */
body {
    margin: 0;
    padding: 0;
}

/* Optional: Add smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .display-1 {
        font-size: 3rem !important;
    }

    .display-4 {
        font-size: 2rem !important;
    }

    .h2 {
        font-size: 1.5rem !important;
    }

    .hero-icon i {
        font-size: 2rem !important;
    }

    .text-primary-custom {
        letter-spacing: 1px;
    }
}

@media (max-width: 576px) {
    .display-1 {
        font-size: 2.5rem !important;
    }

    .btn-lg {
        padding: 0.75rem 2rem !important;
        font-size: 1rem !important;
    }
}
</style>
@endsection