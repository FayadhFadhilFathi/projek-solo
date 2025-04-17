<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\Product;
=======
>>>>>>> 83a19da (pesan commit)
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $products = Product::all(); // Mengambil semua data produk dari database
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|url', // Pastikan URL valid
        ]);

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|url',
        ]);

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
    
=======
        $games = [
            ['name' => 'Game 1', 'description' => 'An amazing adventure game.', 'image' => 'https://via.placeholder.com/150'],
            ['name' => 'Game 2', 'description' => 'A thrilling action game.', 'image' => 'https://via.placeholder.com/150'],
            // Tambahkan lebih dari 20 game
        ];

        // Duplikasikan elemen di atas hingga ada lebih dari 20 game.
        for ($i = 3; $i <= 20; $i++) {
            $games[] = [
                'name' => "Game $i",
                'description' => "Description for Game $i",
                'image' => 'https://via.placeholder.com/150'
            ];
        }

        return view('products', compact('games'));
    }
}
>>>>>>> 83a19da (pesan commit)
