<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // Add this import
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all(); // Fetch categories
        
        return view('home', compact('products', 'categories'));
    }
}