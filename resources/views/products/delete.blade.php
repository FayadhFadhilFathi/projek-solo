@extends('layouts.admin')

@section('title', 'Delete Product')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Delete Product</h4>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-exclamation-triangle fa-4x text-danger"></i>
                    </div>
                    
                    <h5 class="card-title mb-4">Are you sure you want to delete this product?</h5>
                    <p class="fs-5 fw-bold mb-3">{{ $product->name }}</p>
                    
                    @if($product->image)
                    <div class="mb-4">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-thumbnail" style="max-height: 150px;">
                    </div>
                    @endif
                    
                    <p class="mb-4 text-muted">This action cannot be undone.</p>
                    
                    <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('products.index') }}" class="btn btn-secondary me-3">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-1"></i> Yes, Delete
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection