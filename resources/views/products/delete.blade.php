@extends('layouts.admin')

@section('title', 'Delete Product')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Delete Product</h1>
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h2 class="text-2xl font-bold mb-4">Are you sure you want to delete "{{ $product->name }}"?</h2>
        <form action="{{ route('product.destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-center gap-4">
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Yes, Delete
                </button>
                <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection