@extends('layouts.app')

@section('title', 'Dashboard - Shop Products')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@push('styles')
<style>
    .product-image {
        height: 200px;
        overflow: hidden;
        border-radius: 0.75rem 0.75rem 0 0;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .card:hover .product-image img {
        transform: scale(1.05);
    }
    
    .price-badge {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
        font-weight: 600;
        border-radius: 50px;
    }
    
    .stock-badge {
        border-radius: 50px;
    }
    
    .product-card {
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
    }
    
    .product-card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        transform: translateY(-5px);
    }
    
    .btn-buy {
        background: linear-gradient(45deg, #6f42c1, #5a32a3);
        border: none;
        border-radius: 50px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-buy:hover {
        background: linear-gradient(45deg, #5a32a3, #6f42c1);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(111, 66, 193, 0.3);
    }
    
    .btn-cart {
        background: linear-gradient(45deg, #fd7e14, #e76500);
        border: none;
        border-radius: 50px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-cart:hover {
        background: linear-gradient(45deg, #e76500, #fd7e14);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(253, 126, 20, 0.3);
    }
    
    .welcome-section {
        background: linear-gradient(135deg, #6f42c1, #5a32a3);
        color: white;
        border-radius: 1rem;
        padding: 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .welcome-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transform: scale(3);
    }
    
    .stats-card {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border: none;
        border-radius: 1rem;
        transition: all 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
    }
    
    .loading-spinner {
        display: none;
    }
    
    .loading .loading-spinner {
        display: inline-block;
    }
    
    .loading .btn-text {
        display: none;
    }
</style>
@endpush

@section('content')
<!-- Welcome Section -->
<div class="welcome-section text-center position-relative">
    <div class="position-relative">
        <h1 class="display-6 fw-bold mb-3">
            <i class="bi bi-person-heart me-2"></i>
            Welcome back, {{ Auth::user()->name }}!
        </h1>
        <p class="lead mb-4">Discover amazing products and great deals just for you</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('user.order.index') }}" class="btn btn-light btn-lg rounded-pill">
                <i class="bi bi-bag-heart me-2"></i>
                My Orders
            </a>
            <button class="btn btn-outline-light btn-lg rounded-pill" onclick="scrollToProducts()">
                <i class="bi bi-arrow-down me-2"></i>
                Browse Products
            </button>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card stats-card h-100">
            <div class="card-body text-center">
                <i class="bi bi-box-seam display-4 text-primary mb-3"></i>
                <h3 class="fw-bold text-primary">{{ $products->count() }}</h3>
                <p class="text-muted mb-0">Products Available</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card stats-card h-100">
            <div class="card-body text-center">
                <i class="bi bi-star-fill display-4 text-warning mb-3"></i>
                <h3 class="fw-bold text-warning">New</h3>
                <p class="text-muted mb-0">Arrivals Weekly</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card stats-card h-100">
            <div class="card-body text-center">
                <i class="bi bi-truck display-4 text-success mb-3"></i>
                <h3 class="fw-bold text-success">Free</h3>
                <p class="text-muted mb-0">Shipping Available</p>
            </div>
        </div>
    </div>
</div>

<!-- Filter and Search Section -->
<div class="row mb-4">
    <div class="col-md-8">
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-search"></i>
            </span>
            <input type="text" class="form-control" id="searchProducts" placeholder="Search products...">
            <button class="btn btn-outline-primary" type="button">
                <i class="bi bi-funnel me-1"></i>
                Filter
            </button>
        </div>
    </div>
    <div class="col-md-4 text-md-end">
        <div class="btn-group" role="group">
            <input type="radio" class="btn-check" name="viewMode" id="gridView" checked>
            <label class="btn btn-outline-primary" for="gridView">
                <i class="bi bi-grid-3x3-gap"></i>
            </label>
            <input type="radio" class="btn-check" name="viewMode" id="listView">
            <label class="btn btn-outline-primary" for="listView">
                <i class="bi bi-list"></i>
            </label>
        </div>
    </div>
</div>

<!-- Products Section -->
<div id="products-section">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">
            <i class="bi bi-shop me-2"></i>
            Featured Products
        </h2>
        <span class="badge bg-primary rounded-pill fs-6">{{ $products->count() }} items</span>
    </div>

    @if($products->count() > 0)
        <div class="row" id="productGrid">
            @foreach ($products as $product)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4 product-item" data-name="{{ strtolower($product->name) }}">
                    <div class="card product-card h-100">
                        <div class="product-image">
                            @if($product->image)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="card-img-top">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                    <i class="bi bi-image display-1 text-muted"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark mb-2">{{ $product->name }}</h5>
                            
                            <div class="mb-3">
                                <span class="badge price-badge fs-6 me-2">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                                @if($product->stock > 0)
                                    <span class="badge bg-success stock-badge">
                                        <i class="bi bi-check-circle me-1"></i>
                                        {{ $product->stock }} in stock
                                    </span>
                                @else
                                    <span class="badge bg-danger stock-badge">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Out of stock
                                    </span>
                                @endif
                            </div>
                            
                            @if($product->description)
                                <p class="card-text text-muted small mb-3">
                                    {{ Str::limit($product->description, 80) }}
                                </p>
                            @endif
                            
                            <div class="mt-auto">
                                @if($product->stock > 0)
                                    <form action="{{ route('user.order.store') }}" method="POST" class="purchase-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-buy btn-primary">
                                                <span class="loading-spinner spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                                <span class="btn-text">
                                                    <i class="bi bi-cart-plus me-2"></i>
                                                    Buy Now
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <div class="d-grid">
                                        <button class="btn btn-secondary" disabled>
                                            <i class="bi bi-exclamation-triangle me-2"></i>
                                            Out of Stock
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="bi bi-box-seam display-1 text-muted"></i>
            </div>
            <h3 class="text-muted mb-3">No Products Available</h3>
            <p class="text-muted mb-4">We're working hard to bring you amazing products. Please check back soon!</p>
            <a href="{{ url('/') }}" class="btn btn-primary rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>
                Go Home
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchProducts');
    const productItems = document.querySelectorAll('.product-item');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        productItems.forEach(function(item) {
            const productName = item.getAttribute('data-name');
            if (productName.includes(searchTerm)) {
                item.style.display = 'block';
                item.classList.add('fade-in');
            } else {
                item.style.display = 'none';
                item.classList.remove('fade-in');
            }
        });
        
        // Show "no results" message if needed
        const visibleItems = Array.from(productItems).filter(item => item.style.display !== 'none');
        const noResultsMsg = document.getElementById('noResultsMessage');
        
        if (visibleItems.length === 0 && searchTerm !== '') {
            if (!noResultsMsg) {
                const message = document.createElement('div');
                message.id = 'noResultsMessage';
                message.className = 'col-12 text-center py-5';
                message.innerHTML = `
                    <i class="bi bi-search display-1 text-muted mb-3"></i>
                    <h4 class="text-muted">No products found</h4>
                    <p class="text-muted">Try searching with different keywords</p>
                `;
                document.getElementById('productGrid').appendChild(message);
            }
        } else if (noResultsMsg) {
            noResultsMsg.remove();
        }
    });
    
    // Form submission with loading state
    const purchaseForms = document.querySelectorAll('.purchase-form');
    purchaseForms.forEach(function(form) {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
        });
    });
    
    // Smooth scroll to products
    window.scrollToProducts = function() {
        document.getElementById('products-section').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    };
    
    // View mode toggle (placeholder for future implementation)
    const viewModeInputs = document.querySelectorAll('input[name="viewMode"]');
    viewModeInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            if (this.id === 'listView') {
                // Switch to list view (implement as needed)
                console.log('List view selected');
            } else {
                // Switch to grid view (default)
                console.log('Grid view selected');
            }
        });
    });
});

// Add fade-in animation class
const style = document.createElement('style');
style.textContent = `
    .fade-in {
        animation: fadeIn 0.3s ease-in;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
`;
document.head.appendChild(style);
</script>
@endpush