<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>

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
            min-height: calc(100vh - 120px);
            display: flex;
            justify-content: center;
            align-items: center;
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

        /* Form styling */
        .form-container {
            width: 100%;
            max-width: 450px;
            background-color: #FFFFFF;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
        }

        .form-container h2 {
            margin-bottom: 30px;
            text-align: center;
            color: #504B38;
        }

        .form-container label {
            display: block;
            margin-bottom: 8px;
            margin-top: 15px;
            font-weight: bold;
            color: #504B38;
        }

        .form-container input {
            width: 93%;
            padding: 12px 14px;
            border: 1px solid #B9B28A;
            border-radius: 6px;
            background-color: #fdfcf6;
            color: #504B38;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .form-container input:focus {
            outline: none;
            border-color: #504B38;
            box-shadow: 0 0 0 2px rgba(80, 75, 56, 0.1);
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background-color: #504B38;
            color: #FFFFFF;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 15px;
        }

        .form-container button:hover {
            background-color: #B9B28A;
        }

        .error-messages {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        .error-messages ul {
            margin: 0;
            padding-left: 20px;
        }

        .error-messages li {
            margin-bottom: 5px;
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