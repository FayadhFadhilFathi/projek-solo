<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Exception;

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

        // Validasi stock menggunakan helper method
        if (!$product->hasStock($quantity)) {
            return redirect()->back()
                           ->with('error', "Stock tidak mencukupi untuk {$product->name}. Stock tersedia: {$product->stock}");
        }

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

    /**
     * Remove a pending order (cart item)
     */
    public function remove(Request $request, $id)
    {
        try {
            // Find the order that belongs to the authenticated user and is pending
            $order = Order::where('id', $id)
                         ->where('user_id', Auth::id())
                         ->where('status', 'pending')
                         ->with('product')
                         ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found or cannot be removed.'
                ], 404);
            }

            $productName = $order->product->name;
            $order->delete();

            // Return JSON response for AJAX requests
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "'{$productName}' has been removed from your cart."
                ]);
            }

            // Return redirect for regular requests
            return redirect()->route('user.order.index')
                           ->with('success', "'{$productName}' has been removed from your cart.");

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to remove item: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('user.order.index')
                           ->with('error', 'Failed to remove item: ' . $e->getMessage());
        }
    }

    /**
     * Remove multiple pending orders (bulk remove)
     */
    public function removeBulk(Request $request)
    {
        $request->validate([
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:orders,id'
        ]);

        try {
            $orderIds = $request->order_ids;

            // Get orders that belong to the authenticated user and are pending
            $orders = Order::whereIn('id', $orderIds)
                          ->where('user_id', Auth::id())
                          ->where('status', 'pending')
                          ->with('product')
                          ->get();

            if ($orders->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No valid pending orders found to remove.'
                ], 404);
            }

            $removedCount = $orders->count();
            $productNames = $orders->pluck('product.name')->toArray();

            // Delete the orders
            Order::whereIn('id', $orders->pluck('id'))->delete();

            $message = $removedCount === 1 
                ? "'{$productNames[0]}' has been removed from your cart."
                : "{$removedCount} items have been removed from your cart.";

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'removed_count' => $removedCount
                ]);
            }

            return redirect()->route('user.order.index')
                           ->with('success', $message);

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to remove items: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('user.order.index')
                           ->with('error', 'Failed to remove items: ' . $e->getMessage());
        }
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:orders,id'
        ]);

        $orderIds = $request->order_ids;

        // Start database transaction
        DB::beginTransaction();

        try {
            // Get orders that belong to the authenticated user and are pending
            $orders = Order::whereIn('id', $orderIds)
                          ->where('user_id', Auth::id())
                          ->where('status', 'pending')
                          ->with('product') // Load product relation
                          ->get();

            if ($orders->isEmpty()) {
                throw new Exception('No valid pending orders found.');
            }

            // Validate stock availability for all orders
            foreach ($orders as $order) {
                $product = $order->product;

                if (!$product->hasStock($order->quantity)) {
                    throw new Exception("Stock tidak mencukupi untuk {$product->name}. Stock tersedia: {$product->stock}, diminta: {$order->quantity}");
                }
            }

            // Calculate total amount
            $totalAmount = $orders->sum('total_price');

            // Process each order: update status and reduce stock
            foreach ($orders as $order) {
                // Update order status to paid using helper method
                $order->markAsPaid();

                // Reduce product stock using helper method
                $order->product->reduceStock($order->quantity);

                // Optional: Log stock reduction for audit trail
                \Log::info("Stock reduced for product {$order->product->name}: -{$order->quantity}, remaining: {$order->product->fresh()->stock}");
            }

            // Commit the transaction
            DB::commit();

            $orderCount = $orders->count();

            return redirect()->route('user.order.index')
                           ->with('success', "Payment successful! {$orderCount} order(s) totaling $" . number_format($totalAmount, 2) . " have been paid. Stock has been updated.");

        } catch (Exception $e) {
            // Rollback the transaction on any error
            DB::rollback();

            return redirect()->route('user.order.index')
                           ->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    /**
     * Calculate total price for the order
     */
    private function calculateTotalPrice($price, $quantity)
    {
        return $price * $quantity;
    }
}