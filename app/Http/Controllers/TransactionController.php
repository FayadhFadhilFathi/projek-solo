<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Payment;


class TransactionController extends Controller
{
    public function createOrder(Request $request)
{
    $order = Order::create([
        'user_id' => auth()->id(),
        'total_price' => 0, // Nanti akan di-update
        'status' => 'pending',
    ]);

    $totalPrice = 0;

    foreach ($request->items as $item) {
        $product = Product::find($item['product_id']);
        if ($product && $product->stock >= $item['quantity']) {
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price * $item['quantity'],
            ]);

            // Kurangi stok produk
            $product->update(['stock' => $product->stock - $item['quantity']]);

            $totalPrice += $orderItem->price;
        } else {
            return response()->json(['message' => 'Stok tidak cukup untuk produk ' . $product->name], 400);
        }
    }

    // Update total harga
    $order->update(['total_price' => $totalPrice]);

    return response()->json(['order' => $order], 201);
}


public function makePayment(Request $request, $orderId)
{
    $order = Order::find($orderId);

    if (!$order) {
        return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);
    }

    if ($order->status != 'pending') {
        return response()->json(['message' => 'Pesanan sudah dibayar atau dibatalkan'], 400);
    }

    $payment = Payment::create([
        'order_id' => $order->id,
        'payment_method' => $request->payment_method,
        'amount' => $order->total_price,
        'status' => 'completed',
    ]);

    $order->update(['status' => 'paid']);

    return response()->json(['message' => 'Pembayaran berhasil', 'payment' => $payment], 200);
}

}
