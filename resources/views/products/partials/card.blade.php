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
                <a href="{{ route('products.show', $product) }}" class="btn btn-primary">
                    <i class="bi bi-info-circle me-2"></i>View Details
                </a>
            </div>
        </div>
    </div>
</div>