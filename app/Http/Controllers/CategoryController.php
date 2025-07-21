<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Type;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('types')->get();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $types = $category->types;
        $products = $category->products()->with('reviews')->paginate(12);
        
        return view('categories.show', compact('category', 'types', 'products'));
    }

    public function type(Category $category, Type $type)
    {
        $products = Product::where('category_id', $category->id)
                          ->where('type_id', $type->id)
                          ->with('reviews')
                          ->paginate(12);

        return view('categories.type', compact('category', 'type', 'products'));
    }

    public function getTypes($categoryId)
    {
        $types = Type::where('category_id', $categoryId)->get();
        return response()->json($types);
    }

    // Add these below your existing methods
public function create()
{
    return view('admin.categories.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:categories,name',
        'slug' => 'required|string|max:255|unique:categories,slug',
        'icon' => 'nullable|string|max:255',
        'description' => 'nullable|string',
    ]);

    Category::create($validated);

    return redirect()->route('admin.categories.index')
                   ->with('success', 'Category created successfully!');
}

public function edit(Category $category)
{
    return view('admin.categories.edit', compact('category'));
}

public function update(Request $request, Category $category)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
        'slug' => 'required|string|max:255|unique:categories,slug,'.$category->id,
        'icon' => 'nullable|string|max:255',
        'description' => 'nullable|string',
    ]);

    $category->update($validated);

    return redirect()->route('admin.categories.index')
                     ->with('success', 'Category updated successfully!');
}

public function destroy(Category $category)
{
    // Delete all types under this category
    $category->types()->delete();
    
    $category->delete();

    return redirect()->route('admin.categories.index')
                     ->with('success', 'Category deleted successfully!');
}
public function adminIndex()
{
    $categories = Category::withCount('types')->get();
    return view('admin.categories.index', compact('categories'));
}
}