@extends('layouts.admin')

@section('title', 'Create Type for ' . $category->name)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Create New Type for: {{ $category->name }}</h1>
        <a href="{{ route('categories.types.index', $category) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Types
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('categories.types.store', $category) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Type Name *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug *</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                           id="slug" name="slug" value="{{ old('slug') }}" required>
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Unique identifier for the type</small>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save me-2"></i>Create Type
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection