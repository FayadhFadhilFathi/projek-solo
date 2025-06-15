<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function download($orderId)
    {
        $order = Order::with('product')->findOrFail($orderId);

        // Verifikasi kepemilikan order
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Verifikasi status order (paid)
        if (!$order->isPaid()) {
            abort(403, 'Order is not completed.');
        }

        $product = $order->product;

        // Verifikasi file tersedia
        if (!$product->download_file) {
            abort(404, 'File not available.');
        }

        $filePath = storage_path('app/public/' . $product->download_file);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        $fileName = $product->name . '.' . pathinfo($filePath, PATHINFO_EXTENSION);
        
        return response()->download($filePath, $fileName);
    }
}