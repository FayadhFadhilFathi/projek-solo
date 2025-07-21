@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>{{ $type->name }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $type->name }}</li>
                </ol>
            </nav>
            
        </div>
        <a href="{{ route('categories.show', $category) }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to {{ $category->name }}
        </a>
    </div>
    
    <p class="lead">{{ $type->description }}</p>
    
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                @include('products.partials.card', ['product' => $product])
            </div>
        @endforeach
    </div>
    
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection