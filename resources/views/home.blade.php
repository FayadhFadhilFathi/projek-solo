<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #F8F3D9;
            color: #504B38;
        }

        header {
            background-color: #B9B28A;
            color: #F8F3D9;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 1.8em;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 15px;
        }

        nav ul li a,
        nav ul li span,
        nav ul li form button {
            color: #F8F3D9;
            font-weight: bold;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav ul li a:hover,
        nav ul li form button:hover {
            background-color: #EBE5C2;
            color: #504B38;
        }

        main {
            padding: 30px;
            text-align: center;
            margin-bottom: 100px; /* untuk menghindari konten tertutup footer */
        }

        .cta-button {
            display: inline-block;
            margin-top: 20px;
            padding: 15px 30px;
            background-color: #504B38;
            color: #F8F3D9;
            font-size: 1.2em;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s;
        }

        .cta-button:hover {
            background-color: #B9B28A;
        }

        footer {
            background-color: #504B38;
            color: #F8F3D9;
            text-align: center;
            padding: 15px 0;
            width: 100%;
            position: static;
        }

        .banner-image {
            max-width: 26%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .product-section {
            margin-top: 60px;
        }

        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .product-card {
            background-color: #EBE5C2;
            padding: 20px;
            border-radius: 10px;
            width: 200px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            width: 100%;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .product-card button {
            margin: 5px;
            padding: 8px 12px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .buy-button {
            background-color: #504B38;
            color: #F8F3D9;
            border: none;
        }

        .info-button {
            background-color: transparent;
            border: 1px solid #504B38;
            color: #504B38;
        }
    </style>
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
