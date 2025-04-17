<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::with(['product', 'order'])->get();
        return view('order-items.index', compact('orderItems'));
    }

    public function create()
    {
        $orders = Order::all();
        $products = Product::all();
        return view('order-items.create', compact('orders', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        OrderItem::create($request->all());
        return redirect()->route('order-items.index')->with('success', 'Order item created successfully.');
    }

    public function show(OrderItem $orderItem)
    {
        return view('order-items.show', compact('orderItem'));
    }

    public function edit(OrderItem $orderItem)
    {
        $orders = Order::all();
        $products = Product::all();
        return view('order-items.edit', compact('orderItem', 'orders', 'products'));
    }

    public function update(Request $request, OrderItem $orderItem)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $orderItem->update($request->all());
        return redirect()->route('order-items.index')->with('success', 'Order item updated successfully.');
    }

    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();
        return redirect()->route('order-items.index')->with('success', 'Order item deleted successfully.');
    }
}
