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
            color: #F8F3D9;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
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

        nav ul li {
            display: inline;
        }

        nav ul li a, nav ul li form button {
            text-decoration: none;
            color: #F8F3D9;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            background: none;
            border: none;
            cursor: pointer;
        }

        nav ul li a:hover,
        nav ul li form button:hover {
            background-color: #EBE5C2;
            color: #504B38;
        }

        main {
            padding: 30px;
            text-align: center;
            min-height: calc(100vh - 120px);
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
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: 60px;
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

        /* Form styling (shared for login/register) */
        .form-container {
            max-width: 500px;
            margin: 10px auto;
            background-color: #FFFFFF;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            margin-bottom: 30px;
            text-align: center;
            color: #504B38;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            text-align:left;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #B9B28A;
            border-radius: 5px;
        }

        button {
            background-color: #504B38;
            color: #FFFFFF;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #B9B28A;
        }

        .error-messages {
            color: #D9534F;
            margin-bottom: 20px;
        }


        /* Add this to your existing styles in app.blade.php */

.orders-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.orders-table th, .orders-table td {
    border: 1px solid #B9B28A;
    padding: 12px;
    text-align: left;
}

.orders-table th {
    background-color: #B9B28A;
    color: #F8F3D9;
}

.orders-table tr:nth-child(even) {
    background-color: #EBE5C2;
}

.orders-table tr:hover {
    background-color: #D9D9D9;
}

    </style>

    {{-- Tempat untuk custom styles tambahan --}}
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

    {{-- Tempat untuk custom JS --}}
    @stack('scripts')
</body>
</html>
