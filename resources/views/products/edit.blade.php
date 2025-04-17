@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #F8F3D9;
            color: #504B38;
        }

        main {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
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

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group label {
            font-size: 1.1em;
            color: #504B38;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #B9B28A;
            border-radius: 5px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #504B38;
        }

        .form-group img {
            display: block;
            margin-top: 10px;
            max-width: 150px;
            border: 1px solid #B9B28A;
            border-radius: 5px;
        }

        button {
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
    </style>
<div class="container mt-4">
        <h1>Edit Product</h1>
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image URL</label>
                <input type="url" class="form-control" id="image" name="image" value="{{ $product->image }}">
            </div>
            <button type="submit" class="btn btn-success">Update Product</button>
        </form>
    </div>
@endsection
