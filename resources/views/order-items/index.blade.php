@extends('layouts.app')

@section('content')
<h1>Order Items</h1>
<a href="{{ route('order-items.create') }}">Create New Order Item</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Order ID</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orderItems as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->order->id }}</td>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->price }}</td>
            <td>
                <a href="{{ route('order-items.show', $item->id) }}">View</a>
                <a href="{{ route('order-items.edit', $item->id) }}">Edit</a>
                <form action="{{ route('order-items.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
