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
@endsection
