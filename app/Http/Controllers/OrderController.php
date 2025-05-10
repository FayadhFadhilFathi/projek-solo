<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Menampilkan daftar produk untuk dipesan
    public function index()
{
    // Fetch orders for the authenticated user
    $orders = Order::with('product')->where('user_id', Auth::id())->get();
    return view('user.order.index', compact('orders')); // Pass the orders to the view
}


    // Menyimpan pesanan ke database
    public function store(Request $request)
{
    // Validate the incoming request data
    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);
    // Create the order
    $order = new Order();
    $order->user_id = Auth::id();
    $order->product_id = $validated['product_id'];
    $order->quantity = $validated['quantity'];
    $order->total_price = $this->calculateTotalPrice($validated['product_id'], $validated['quantity']);
    $order->status = 'completed';
    $order->save();
    // Flash a success message
    return redirect()->route('user.order.checkout')->with('success', 'You have successfully purchased the product!');
}
    
    
    



    // Menampilkan halaman checkout
    public function checkout()
{
    // Eager load the product relationship
    $order = Order::with('product')->where('user_id', Auth::id())->latest()->first();
    // Check if the order exists
    if (!$order || !$order->product) { // Check if the product is also loaded
        return redirect()->route('user.order.index')->with('error', 'No order found. Please place an order first.');
    }
    return view('user.order.checkout', compact('order')); // Pass the order to the view
}

    
}
