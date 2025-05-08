@extends('layouts.app')

@section('content')
<main>
    <h1>My Orders</h1>
    <ul>
        @foreach($orders as $order)
            <li>
                {{ $order->product->name }} - Quantity: {{ $order->quantity }}
            </li>
        @endforeach
    </ul>
</main>
@endsection
