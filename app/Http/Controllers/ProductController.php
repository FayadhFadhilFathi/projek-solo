<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // ... validasi lainnya
        'download_file' => 'nullable|file',
    ]);

    $data = $request->all();

    if ($request->hasFile('download_file')) {
        $file = $request->file('download_file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        
        // Gunakan streaming untuk file besar
        $stream = fopen($file->getRealPath(), 'r');
        Storage::disk('public')->put('downloads/' . $fileName, $stream);
        
        if (is_resource($stream)) {
            fclose($stream);
        }
        
        $data['download_file'] = 'downloads/' . $fileName;
    }

    Product::create($data);
    return redirect()->route('products.index');
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
            'download_file' => 'nullable|file|mimes:pdf,zip,doc,docx,ppt,pptx,txt|max:20480',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('download_file')) {
            // Hapus file lama jika ada
            if ($product->download_file) {
                Storage::disk('public')->delete($product->download_file);
            }
            
            $file = $request->file('download_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('downloads', $fileName, 'public');
            $data['download_file'] = $path;
        } else {
            // Pertahankan file yang ada jika tidak ada file baru diupload
            $data['download_file'] = $product->download_file;
        }

        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        // Hapus file terkait
        if ($product->download_file) {
            Storage::disk('public')->delete($product->download_file);
        }
        
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

    // Method baru untuk download file
    public function download(Product $product)
    {
        if (!$product->download_file) {
            abort(404, 'File tidak ditemukan');
        }

        $filePath = storage_path('app/public/' . $product->download_file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($filePath);
    }
}