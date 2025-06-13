@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="container">
    <div class="admin-header">
        <h1 class="text-center mb-0">User Management</h1>
    </div>

    <div class="text-end mb-4">
        <a href="{{ route('users.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Add New User
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <table class="table table-striped table-hover rounded">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if(count($users) == 0)
    <div class="text-center p-5">
        <div class="mb-4">
            <i class="fas fa-user fa-4x text-muted"></i>
        </div>
        <h3>No users found</h3>
        <p class="text-muted">Start by adding your first user</p>
        <a href="{{ route('users.create') }}" class="btn btn-primary mt-3">Add User</a>
    </div>
    @endif
</div>
@endsection
