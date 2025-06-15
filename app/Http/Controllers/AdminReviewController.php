<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'product'])->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $review->update(['status' => $request->status]);

        return back()->with('success', 'Review status updated successfully.');
    }
}