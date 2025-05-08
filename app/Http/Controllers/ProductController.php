<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        // Only admin can access create, store, edit, update, destroy
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
        $this->middleware('auth'); // All routes can only be accessed by logged-in users
    }

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'))->with('success', 'Get All Products');
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
            'image' => 'nullable|url', // Ensure the URL is valid
        ]);
        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Product created successfully!'); // Redirect to products.index
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

    public function showIndexProduct()
    {
        return view('products.index');
    }

    // Method to show delete confirmation
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        return view('products.delete', compact('product'));
    }
}
