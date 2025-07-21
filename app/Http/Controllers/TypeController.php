<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index(Category $category)
    {
        $types = $category->types()->paginate(10);
        return view('admin.types.index', compact('category', 'types'));
    }

    public function create(Category $category)
    {
        return view('admin.types.create', compact('category'));
    }

    public function store(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:types,slug',
            'description' => 'nullable|string',
        ]);

        $category->types()->create($validated);

        return redirect()->route('categories.types.index', $category)
                         ->with('success', 'Type created successfully!');
    }

    public function edit(Category $category, Type $type)
    {
        return view('admin.types.edit', compact('category', 'type'));
    }

    public function update(Request $request, Category $category, Type $type)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:types,slug,' . $type->id,
            'description' => 'nullable|string',
        ]);

        $type->update($validated);

        return redirect()->route('categories.types.index', $category)
                         ->with('success', 'Type updated successfully!');
    }

    public function destroy(Category $category, Type $type)
    {
        if ($type->products()->exists()) {
            return back()->with('error', 'Cannot delete type with associated products!');
        }

        $type->delete();

        return redirect()->route('categories.types.index', $category)
                         ->with('success', 'Type deleted successfully!');
    }
}