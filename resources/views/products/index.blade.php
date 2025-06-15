@extends('layouts.admin')

@section('title', 'Product List')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard
    </a>
</div>
<div class="container">
    <div class="admin-header">
        <h1 class="text-center mb-0">Product Management</h1>
    </div>

    <div class="text-end mb-4">
        <a href="{{ route('product.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Add New Product
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="text-center pt-3">
                    @if ($product->image)
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid rounded" style="height: 150px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                            <span class="text-muted fst-italic">No Image Available</span>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title fw-bold">
                        <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                            {{ $product->name }}
                        </a>
                    </h5>
                    <p class="card-text text-truncate">{{ $product->description ?? 'No description available' }}</p>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item bg-transparent">
                            <strong>Price:</strong> ${{ number_format($product->price, 2) }}
                        </li>
                        <li class="list-group-item bg-transparent">
                            <strong>Stock:</strong> {{ $product->stock }}
                        </li>
                    </ul>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <a href="{{ route('product.delete', $product->id) }}" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this product?')">
                            <i class="fas fa-trash me-1"></i> Delete
                        </a>
                    </div>

                    @if($product->download_file)
                        <div class="mt-2 text-center">
                            <a href="{{ route('products.download', $product->id) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-download me-1"></i> Download File
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if(count($products) == 0)
    <div class="text-center p-5">
        <div class="mb-4">
            <i class="fas fa-box-open fa-4x text-muted"></i>
        </div>
        <h3>No products found</h3>
        <p class="text-muted">Start by adding your first product</p>
        <a href="{{ route('product.create') }}" class="btn btn-primary mt-3">Add Product</a>
    </div>
    @endif
</div>
@endsection