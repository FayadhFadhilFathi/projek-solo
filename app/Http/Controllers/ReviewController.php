<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Order $order)
    {
        // Validate the request
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        // Check if the user already reviewed this order
        if ($order->review) {
            return back()->with('error', 'You have already reviewed this order.');
        }

        // Create the review
        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $order->product_id,
            'order_id' => $order->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'pending', // Admin will approve
        ]);

        return back()->with('success', 'Thank you for your review! It will be visible after approval.');
    }
}