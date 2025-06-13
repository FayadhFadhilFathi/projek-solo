<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                      ->with('product')
                      ->orderBy('created_at', 'desc')
                      ->get();
        
        return view('user.order.index', compact('orders'));
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())
                      ->with('product')
                      ->orderBy('updated_at', 'desc')
                      ->get();
        
        return view('user.order.history', compact('orders'));
    }

    public function checkout()
    {
        return view('user.order.checkout');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;
        
        // Calculate total price
        $totalPrice = $this->calculateTotalPrice($product->price, $quantity);

        // Create order with your existing structure
        $order = Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        return redirect()->route('user.order.index')
                        ->with('success', 'Order placed successfully!');
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:orders,id'
        ]);

        $orderIds = $request->order_ids;
        
        // Get orders that belong to the authenticated user and are pending
        $orders = Order::whereIn('id', $orderIds)
                      ->where('user_id', Auth::id())
                      ->where('status', 'pending')
                      ->get();

        if ($orders->isEmpty()) {
            return redirect()->route('user.order.index')
                           ->with('error', 'No valid pending orders found.');
        }

        // Calculate total amount
        $totalAmount = $orders->sum('total_price');

        // Here you would integrate with your payment gateway
        // For now, we'll simulate a successful payment
        
        // Update order status to paid
        $orders->each(function ($order) {
            $order->update([
                'status' => 'paid',
                'updated_at' => now()
            ]);
        });

        $orderCount = $orders->count();
        
        return redirect()->route('user.order.index')
                        ->with('success', "Payment successful! {$orderCount} order(s) totaling $" . number_format($totalAmount, 2) . " have been paid.");
    }

    /**
     * Calculate total price for the order
     */
    private function calculateTotalPrice($price, $quantity)
    {
        return $price * $quantity;
    }
}