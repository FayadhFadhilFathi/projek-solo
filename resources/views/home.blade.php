@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}" />
</head>

<body>
    <header>
        <h1>Welcome to Equipbuild</h1>
    </header>

    <main>
        <!-- Section 1: Banner -->
        <section class="banner-section">
            <img src="{{ asset('image/logo.png') }}" alt="Shop Banner" class="banner-image" />
            <h2>RANCANG RUANG KERJA, BANGUN PRESISI</h2>
            <p>Your One-Stop Shop for All Your Needs</p>
            <p>Explore a wide variety of products and enjoy seamless transactions!</p>
            @auth
                <a href="{{ route('dashboard') }}" class="cta-button">Shop Now</a>
            @else
                <a href="{{ route('login') }}" class="cta-button">Shop Now</a>
            @endauth
        </section>

        <!-- Section 2: Products -->
        <section class="product-section">
            <h2>Selamat Datang di Equipbuild</h2>
            <p>Kami menyediakan berbagai alat dan bahan bangunan berkualitas tinggi untuk kebutuhan Anda!</p>

            <div class="product-grid">
                @foreach ($products as $product)
                    <div class="product-card">
                        <div class="product-image-container">
                            @if ($product->image)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" />
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 150px; border-radius: 8px;">
                                    <span class="text-muted fst-italic">No Image Available</span>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <h3>{{ $product->name }}</h3>
                            <p class="product-description">{{ $product->description ?? 'No description available' }}</p>
                            <div class="product-details">
                                <div class="detail-item">
                                    <strong>Price:</strong>
                                    <span>${{ number_format($product->price, 2) }}</span>
                                </div>
                                <div class="detail-item">
                                    <strong>Stock:</strong>
                                    <span>{{ $product->stock }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            @auth
                                <a href="{{ route('dashboard') }}" class="buy-button">Beli Sekarang</a>
                            @else
                                <a href="{{ route('login') }}" class="buy-button">Beli Sekarang</a>
                            @endauth
                            <button class="info-button">Lihat Info</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
</body>
</html>
@endsection