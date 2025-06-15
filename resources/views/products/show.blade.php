@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary me-2">
        <i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard
    </a>
    <a href="{{ route('product.index') }}" class="btn btn-primary">
        <i class="fas fa-list me-2"></i> Daftar Produk
    </a>
</div>
<div class="container py-4">
    <div class="row">
        <div class="col-md-6">
            <div class="product-image mb-4">
                @if($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid rounded">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                        <i class="bi bi-image display-4 text-muted"></i>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <h1 class="mb-3">{{ $product->name }}</h1>
            
            @if($product->reviewsCount() > 0)
                <div class="star-rating mb-3">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $product->averageRating())
                            <i class="fas fa-star text-warning"></i>
                        @elseif($i - 0.5 <= $product->averageRating())
                            <i class="fas fa-star-half-alt text-warning"></i>
                        @else
                            <i class="far fa-star text-warning"></i>
                        @endif
                    @endfor
                    <span class="ms-2">{{ number_format($product->averageRating(), 1) }} ({{ $product->reviewsCount() }} reviews)</span>
                </div>
            @endif

            <h4 class="text-primary mb-3">${{ number_format($product->price, 2) }}</h4>
            
            <div class="mb-4">
                <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                    {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                </span>
            </div>

            @if($product->description)
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Description</h5>
                        <p class="card-text">{{ $product->description }}</p>
                    </div>
                </div>
            @endif

            @if($product->stock > 0)
                <form action="{{ route('user.order.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" 
                                   value="1" min="1" max="{{ $product->stock }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-cart-plus me-2"></i> Add to Cart
                    </button>
                </form>
            @else
                <button class="btn btn-secondary btn-lg" disabled>
                    <i class="fas fa-exclamation-circle me-2"></i> Out of Stock
                </button>
            @endif
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Customer Reviews</h3>
                    
                    @if($product->reviewsCount() > 0)
                        <div class="mb-4">
                            @foreach($product->reviews as $review)
                                <div class="review-item mb-4 pb-3 border-bottom">
                                    <div class="d-flex justify-content-between mb-2">
                                        <h5 class="mb-0">{{ $review->user->name }}</h5>
                                        <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                                    </div>
                                    <div class="star-rating mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star{{ $i <= $review->rating ? ' text-warning' : ' text-secondary' }}"></i>
                                        @endfor
                                    </div>
                                    <p class="mb-0">{{ $review->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-comment-slash fa-3x text-muted mb-3"></i>
                            <h5>No reviews yet</h5>
                            <p class="text-muted">Be the first to review this product</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .star-rating {
        color: #ffc107;
        font-size: 1.25rem;
    }
    .star-rating i {
        margin-right: 2px;
    }
    .review-item {
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
    }
</style>
@endpush