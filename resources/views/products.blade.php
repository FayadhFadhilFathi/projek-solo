<<<<<<< HEAD
@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #F8F3D9;
            color: #504B38;
        }

        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .product-card {
            background-color: #FFFFFF;
            border: 1px solid #B9B28A;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
        }

        .product-card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .product-card h3 {
            margin: 15px 0;
            font-size: 1.5em;
        }

        .product-card p {
            margin-bottom: 15px;
            color: #7D7A65;
        }

        .product-card button {
            background-color: #504B38;
            color: #FFFFFF;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
        }

        .product-card button:hover {
            background-color: #B9B28A;
        }
    </style>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #F8F3D9; /* Sama dengan home.blade.php */
        color: #504B38; /* Sama dengan home.blade.php */
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

        nav ul li {
            display: inline;
        }

        nav ul li a {
            text-decoration: none;
            color: #F8F3D9;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav ul li a:hover {
            background-color: #EBE5C2;
            color: #504B38;
        }

    .product-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    .product-card {
        background-color: #EBE5C2; /* Warna yang cocok dengan home.blade.php */
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        padding: 15px;
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.15);
    }

    .product-card img {
        max-width: 100%;
        border-radius: 5px;
    }

    .product-card h3 {
        margin: 10px 0 5px;
        font-size: 1.2em;
    }

    .product-card p {
        margin: 0 0 10px;
        font-size: 0.9em;
    }

    .product-card button {
        background-color: #504B38; /* Sama dengan tombol di home.blade.php */
        color: #F8F3D9; /* Sama dengan tombol di home.blade.php */
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .product-card button:hover {
        background-color: #B9B28A; /* Sama dengan hover link di home.blade.php */
    }

    footer {
            background-color: #504B38;
            color: #F8F3D9;
            text-align: center;
            padding: 15px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
</style>

</head>
<body>
    <header>
        <h1>Our Games</h1>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/products">Products</a></li>
                <li><a href="/cart">Cart</a></li>
                <li><a href="/checkout">Checkout</a></li>
            </ul>
        </nav>
    </header>
    <footer>
    <p>&copy; 2025 Your Store. All Rights Reserved.</p>
    </footer>

>>>>>>> 83a19da (pesan commit)

    <div class="product-container">
        @foreach($games as $game)
            <div class="product-card">
                <img src="{{ $game['image'] }}" alt="Game Image">
                <h3>{{ $game['name'] }}</h3>
                <p>{{ $game['description'] }}</p>
                <button>Choose</button>
            </div>
        @endforeach
    </div>
<<<<<<< HEAD
@endsection
=======
</body>
</html>
>>>>>>> 83a19da (pesan commit)
