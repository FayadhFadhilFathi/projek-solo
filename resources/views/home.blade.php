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
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/products">Products</a></li>
                @auth
                    <li><a href="/cart">Cart</a></li>
                    <li><a href="/checkout">Checkout</a></li>
                    <li><span>Hi, {{ Auth::user()->name }}</span></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                    @if (auth()->user()->role === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                    @else
                        <li><a href="{{ route('user.order.index') }}">My Orders</a></li>
                    @endif
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    <main>
    <section class="product-section">
        <img src="{{ asset('image/logo.png') }}" alt="Shop Banner" class="banner-image" />
        <h2>Your One-Stop Shop for All Your Needs</h2>
        <p>Explore a wide variety of products and enjoy seamless transactions!</p>
        @auth
            <a href="{{ route('dashboard') }}" class="cta-button">Shop Now</a>
        @else
            <a href="{{ route('login') }}" class="cta-button">Shop Now</a>
        @endauth
    </section>

    <section class="product-section">
        <h2>Selamat Datang di Equipbuild</h2>
        <p>Kami menyediakan berbagai alat dan bahan bangunan berkualitas tinggi untuk kebutuhan Anda!</p>

        <div class="product-grid">
            @foreach ($products as $product)
                <div class="product-card">
                    <h3>{{ $product->name }}</h3>
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" />
                    @auth
                        <a href="{{ route('dashboard') }}" class="buy-button">Beli Sekarang</a>
                    @else
                        <a href="{{ route('login') }}" class="buy-button">Beli Sekarang</a>
                    @endauth
                    <button class="info-button">Lihat Info</button>
                </div>
            @endforeach
        </div>
    </section>
</main>

    <footer>
        <p>&copy; 2025 Your Store. All Rights Reserved.</p>
    </footer>
</body>

</html>

