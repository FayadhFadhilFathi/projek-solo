<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Menampilkan daftar produk untuk dipesan
    public function index()
    {
        $products = Product::all();
        return view('orders.index', compact('products'));
    }

    // Menyimpan pesanan ke database
    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $request->total_price,
            'status' => 'pending',
        ]);

        // Logika tambahan untuk menyimpan item ke tabel order_items
        // ...

        return redirect()->route('order.checkout')->with('success', 'Order berhasil dibuat!');
    }

    // Menampilkan halaman checkout
    public function checkout()
    {
        $order = Order::where('user_id', Auth::id())->latest()->first();
        return view('orders.checkout', compact('order'));
    }
}
