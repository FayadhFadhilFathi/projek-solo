@extends('layouts.app')

@section('content')
<main>
    <h1>My Orders</h1>
    <table class="orders-table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->product->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>${{ number_format($order->total_price, 2) }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</main>
@endsection