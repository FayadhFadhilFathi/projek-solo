@extends('layouts.admin')

@section('title', 'Product List')

@section('content')
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #F8F3D9;
            color: #504B38;
        }

        main {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #FFFFFF;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2em;
            text-align: center;
            margin-bottom: 20px;
            color: #504B38;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #B9B28A;
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #504B38;
            color: #F8F3D9;
        }

        table tr:nth-child(even) {
            background-color: #F8F3D9;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .action-buttons a {
            text-decoration: none;
            padding: 8px 12px;
            font-size: 0.9em;
            color: #F8F3D9;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .action-buttons .edit {
            background-color: #B9B28A;
        }

        .action-buttons .delete {
            background-color: #E63946;
        }

        .action-buttons a:hover {
            opacity: 0.8;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1.1em;
            font-weight: bold;
            background-color: #504B38;
            color: #F8F3D9;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #B9B28A;
        }

        /* Styles for the product image to keep it at a manageable size */
        .product-image {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover; /* maintains aspect ratio and cropping if needed */
            border-radius: 8px;
        }

        /* Style for the placeholder when no image exists */
        .no-image-placeholder {
            width: 150px;
            height: 150px;
            background-color: #d3d3d3;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666666;
            font-style: italic;
        }
    </style>

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Product List</h1>

        <div class="text-right mb-6">
            <a href="{{ route('product.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                + Add New Product
            </a>
        </div>

        @foreach ($products as $product)
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-bold mb-4">{{ $product->name }}</h2>

                <div class="flex gap-4">
                    @if ($product->image)
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-image">
                    @else
                        <div class="no-image-placeholder">
                            No Image
                        </div>
                    @endif

                    <div>
                        <p class="text-gray-700 mb-2"><strong>Description:</strong> {{ $product->description ?? 'No description available' }}</p>
                        <p class="text-gray-700 mb-2"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                        <p class="text-gray-700 mb-2"><strong>Stock:</strong> {{ $product->stock }}</p>
                        <p class="text-gray-700"><strong>Created At:</strong> {{ $product->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('product.edit', $product->id) }}" class="edit">Edit</a>
                    <a href="{{ route('product.delete', $product->id) }}" class="delete"
                       onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection