<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::all();
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
            'image' => 'nullable|url',
            'download_file' => 'nullable|file|max:102400', // 100MB max
        ]);

        $data = $request->all();

        if ($request->hasFile('download_file')) {
            $file = $request->file('download_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('downloads', $fileName, 'public');
            $data['download_file'] = $path;
        }

        Product::create($data);
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
            'download_file' => 'nullable|file|max:102400', // 100MB max
        ]);

        $data = $request->all();

        if ($request->hasFile('download_file')) {
            // Delete old file if exists
            if ($product->download_file) {
                Storage::disk('public')->delete($product->download_file);
            }
            
            // Upload new file
            $file = $request->file('download_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('downloads', $fileName, 'public');
            $data['download_file'] = $path;
        } else {
            // Keep existing file
            $data['download_file'] = $product->download_file;
        }

        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        // Delete associated file
        if ($product->download_file) {
            Storage::disk('public')->delete($product->download_file);
        }
        
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        return view('products.delete', compact('product'));
    }

    public function download(Product $product)
    {
        if (!$product->download_file) {
            abort(404, 'File not found');
        }

        $filePath = storage_path('app/public/' . $product->download_file);

        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        return response()->download($filePath, $product->name . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
    }

    public function search(Request $request)
{
    $query = $request->input('query');
    
    $products = Product::where('name', 'like', "%$query%")
        ->orWhere('description', 'like', "%$query%")
        ->get();
        
    return view('products.index', compact('products'));
}
}