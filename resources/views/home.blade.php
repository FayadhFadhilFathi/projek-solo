<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

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
                @else
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    <main>
        <section class="product-section">
            <img src="{{ asset('image/logo.png') }}" alt="Shop Banner" class="banner-image">
            <h2>Your One-Stop Shop for All Your Needs</h2>
            <p>Explore a wide variety of products and enjoy seamless transactions!</p>

            @auth
            <a href="{{ route('products.index') }}" class="cta-button">Shop Now</a>
            @else
            <a href="{{ route('login') }}" class="cta-button">Shop Now</a>
            @endauth
        </section>

        <section class="product-section">
            <h2>Selamat Datang di Equipbuild</h2>
            <p>Kami menyediakan berbagai alat dan bahan bangunan berkualitas tinggi untuk kebutuhan Anda!</p>

            <div class="product-grid">
                <!-- Produk 1 -->
                <div class="product-card">
                    <h3>Obeng Serbaguna</h3>
                    <img src="{{ asset('image/obeng.jpg') }}" alt="Obeng Serbaguna">
                    <button class="buy-button">Beli Sekarang</button>
                    <button class="info-button">Lihat Info</button>
                </div>

                <!-- Produk 2 -->
                <div class="product-card">
                    <h3>Gergaji Baja</h3>
                    <img src="{{ asset('image/gergaji.jpg') }}" alt="Gergaji Baja">
                    <button class="buy-button">Beli Sekarang</button>
                    <button class="info-button">Lihat Info</button>
                </div>

                <!-- Produk 3 -->
                <div class="product-card">
                    <h3>Paku Besi 5cm</h3>
                    <img src="{{ asset('image/paku.jpg') }}" alt="Paku Besi">
                    <button class="buy-button">Beli Sekarang</button>
                    <button class="info-button">Lihat Info</button>
                </div>

                <!-- Produk 4 -->
                <div class="product-card">
                    <h3>Semen Instan</h3>
                    <img src="{{ asset('image/semen.jpg') }}" alt="Semen Instan">
                    <button class="buy-button">Beli Sekarang</button>
                    <button class="info-button">Lihat Info</button>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Your Store. All Rights Reserved.</p>
    </footer>
</body>

</html>
