@extends('layouts.app')

@section('title', 'Dashboard - Shop Products')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #F8F3D9;
        color: #504B38;
    }
    main {
        max-width: 1200px;
        margin: 50px auto;
        padding: 20px;
    }
    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #504B38;
    }
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }
    .product-card {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.2s;
    }
    .product-card:hover {
        transform: translateY(-5px);
    }
    .product-image img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .product-info {
        padding: 15px;
    }
    .product-info h2 {
        font-size: 1.25rem;
        margin-bottom: 10px;
        color: #504B38;
    }
    .product-info p {
        font-size: 0.95rem;
        margin-bottom: 5px;
        color: #666;
    }
    .product-actions {
        margin-top: 10px;
    }
    .buy-btn, .cart-btn {
        display: inline-block;
        margin-top: 5px;
        padding: 8px 12px;
        border: none;
        background-color: #504B38;
        color: #F8F3D9;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        font-size: 0.9em;
        transition: background-color 0.3s;
    }
    .cart-btn {
        background-color: #B9B28A;
    }
    .buy-btn:hover, .cart-btn:hover {
        opacity: 0.85;
    }
</style>

<main>
    <h1>Welcome, {{ Auth::user()->name }}! 🛒</h1>

    <div class="text-right mb-4">
        <a href="{{ route('user.order.index') }}" class="cart-btn">
            🛍️ View My Cart
        </a>
    </div>

    <div class="product-grid">
        @forelse ($products as $product)
            <div class="product-card">
                <div class="product-image">
                    @if($product->image)
                        <img src="{{ $product->image }}" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/300x200?text=No+Image" alt="No Image">
                    @endif
                </div>
                <div class="product-info">
                    <h2>{{ $product->name }}</h2>
                    <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                    <p><strong>Stock:</strong> {{ $product->stock }}</p>

                    <div class="product-actions">
                    <form action="{{ route('user.order.index') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="buy-btn">Buy Now</button>
                    </form>

                    <form action="{{ route('user.order.index') }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="cart-btn">Add to Cart</button>
                    </form>

                    </div>
                </div>
            </div>
        @empty
            <p>No products available right now. Please come back later!</p>
        @endforelse
    </div>
</main>
@endsection
