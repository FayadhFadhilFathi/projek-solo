<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
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
            gap: 20px; /* Increased gap for better spacing */
        }

        nav ul li {
            display: inline;
        }

        nav ul li a {
            text-decoration: none;
            color: #F8F3D9;
            font-weight: bold;
            padding: 10px 15px; /* Increased padding for better click area */
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        nav ul li a:hover {
            background-color: #EBE5C2;
            color: #504B38;
        }

        nav ul li form {
            display: inline; /* Keep the logout button inline */
        }

        main {
            padding: 30px;
            min-height: calc(100vh - 120px); /* Ensure content doesn't overlap with header/footer */
        }

        footer {
            background-color: #504B38;
            color: #F8F3D9;
            text-align: center;
            padding: 15px 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ route('products.index') }}">Manage Products</a></li>
                <li><a href="{{ route('users.index') }}">Manage Users</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #F8F3D9; font-weight: bold; cursor: pointer;">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2025 Your Store. All Rights Reserved.</p>
    </footer>
</body>
</html>