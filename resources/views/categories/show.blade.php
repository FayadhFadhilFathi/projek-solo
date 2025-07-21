@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $category->name }}</h1>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Categories
        </a>
    </div>
    
    <p class="lead">{{ $category->description }}</p>
    
    <div class="mb-4">
        <h4>Filter by Type:</h4>
        <div class="d-flex flex-wrap gap-2">
            @foreach ($types as $type)
                <a href="{{ route('categories.type', [$category, $type]) }}" 
                   class="btn btn-outline-primary">
                    {{ $type->name }}
                </a>
            @endforeach
        </div>
    </div>
    
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