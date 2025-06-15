@extends('layouts.admin')

@section('title', 'Manage Reviews')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard
    </a>
</div>
<div class="container">
    <h1 class="mb-4">Manage Reviews</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reviews as $review)
                    <tr>
                        <td>{{ $review->id }}</td>
                        <td>{{ $review->user->name }}</td>
                        <td>{{ $review->product->name }}</td>
                        <td>{{ $review->rating }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($review->comment, 50) }}</td>
                        <td>
                            <span class="badge bg-{{ $review->status === 'approved' ? 'success' : ($review->status === 'rejected' ? 'danger' : 'warning') }}">
                                {{ $review->status }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="btn-group" role="group">
                                    <button type="submit" name="status" value="approved" class="btn btn-sm btn-success" {{ $review->status === 'approved' ? 'disabled' : '' }}>
                                        Approve
                                    </button>
                                    <button type="submit" name="status" value="rejected" class="btn btn-sm btn-danger" {{ $review->status === 'rejected' ? 'disabled' : '' }}>
                                        Reject
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No reviews found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $reviews->links() }}
</div>
@endsection