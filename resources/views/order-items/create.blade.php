@extends('layouts.app')

@section('content')
<h1>Create Order Item</h1>

<form action="{{ route('order-items.store') }}" method="POST">
    @csrf
    <label for="order_id">Order:</label>
    <select name="order_id" id="order_id">
        @foreach($orders as $order)
        <option value="{{ $order->id }}">{{ $order->id }}</option>
        @endforeach
    </select>

    <label for="product_id">Product:</label>
    <select name="product_id" id="product_id">
        @foreach($products as $product)
        <option value="{{ $product->id }}">{{ $product->name }}</option>
        @endforeach
    </select>

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" id="quantity" min="1" required>

    <label for="price">Price:</label>
    <input type="number" name="price" id="price" min="0" required>

    <button type="submit">Save</button>
</form>
@endsection
