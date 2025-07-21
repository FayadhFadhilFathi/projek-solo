@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Product Categories</h1>
    
    <div class="row">
        @foreach ($categories as $category)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    @if($category->icon)
                        <i class="bi {{ $category->icon }} display-4 mb-3 text-primary"></i>
                    @endif
                    <h3 class="card-title">{{ $category->name }}</h3>
                    <p class="card-text">{{ $category->description }}</p>
                    <a href="{{ route('categories.show', $category) }}" class="btn btn-primary">
                        Browse Products <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="card-footer bg-light">
                    <h6 class="mb-2">Product Types:</h6>
                    <div class="d-flex flex-wrap">
                        @foreach ($category->types as $type)
                            <a href="{{ route('categories.type', [$category, $type]) }}" 
                               class="badge bg-secondary me-1 mb-1 text-decoration-none">
                                {{ $type->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection