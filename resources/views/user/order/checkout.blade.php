@extends('layouts.app')

@section('content')
<main>
    <h1>Checkout</h1>
    <p>Proceed to payment to complete your order.</p>

    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(isset($order))
        <h2>Order Summary</h2>
        <p><strong>Product:</strong> {{ $order->product->name }}</p>
        <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
        <p><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>

        <form action="{{ route('user.order.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $order->product->id }}">
            <input type="hidden" name="quantity" value="{{ $order->quantity }}">
            <button type="submit" class="btn btn-primary">Confirm Purchase</button>
        </form>
    @else
        <p>No order details available. Please place an order first.</p>
    @endif
</main>
@endsection