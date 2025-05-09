<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #F8F3D9;
            color: #504B38;
        }

        header {
            background-color: #B9B28A;
            color: #fff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        header h1 {
            margin: 0;
            font-size: 1.5rem;
            
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        nav a, nav button {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            background: transparent;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
        }

        nav a:hover, nav button:hover {
            background-color: #EBE5C2;
            color: #504B38;
        }

        main {
            padding: 20px 20px;
            text-align: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .cta-button {
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #B9B28A;
            color: #fff;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .cta-button:hover {
            background-color: #504B38;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .product-card {
            background-color: #EBE5C2;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .product-card img {
            width: 100%;
            max-width: 180px;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .product-card h3 {
            margin: 10px 0 5px;
        }

        .product-card p {
            margin: 3px 0;
        }

        .product-card button {
            width: 100%;
            padding: 8px;
            margin-top: 8px;
            border-radius: 5px;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        .buy-button {
            background-color: #504B38;
            color: #fff;
        }

        .buy-button:hover {
            background-color: #B9B28A;
        }

        .cart-button {
            background-color: #D9D2A9;
            color: #504B38;
        }

        footer {
            background-color: #504B38;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            margin-top: 60px;
        }
    </style>

    @stack('styles')
</head>
<body>
    <header>
        <h1>Project Store</h1>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                @auth
                    @if (auth()->user()->role === 'admin')
                        <li><a href="{{ route('products.index') }}">Admin Dashboard</a></li>
                    @else
                        <li><a href="{{ route('user.order.index') }}">My Orders</a></li>
                    @endif
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
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
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2025 Your Store. All Rights Reserved.</p>
    </footer>

    @stack('scripts')
</body>
</html>
