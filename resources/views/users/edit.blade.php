@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.show', $user) }}">{{ $user->name }}</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-user-edit me-2"></i>Edit User: {{ $user->name }}
                    </h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Please fix the following errors:</h6>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user me-1"></i>Full Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $user->name) }}" 
                                           placeholder="Enter full name"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope me-1"></i>Email Address <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', $user->email) }}" 
                                           placeholder="Enter email address"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if($user->email !== old('email', $user->email))
                                        <small class="form-text text-warning">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            Changing email may affect user login access.
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">
                                <i class="fas fa-shield-alt me-1"></i>User Role <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="">Select user role</option>
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>
                                    User
                                </option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($user->role !== old('role', $user->role))
                                <small class="form-text text-warning">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    Changing role will affect user permissions immediately.
                                </small>
                            @endif
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Password Information:</strong>
                            <p class="mb-0 mt-2">
                                Password cannot be changed through this form for security reasons. 
                                If the user needs a password reset, they should use the "Forgot Password" feature on the login page.
                            </p>
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Role Information:</strong>
                            <ul class="mb-0 mt-2">
                                <li><strong>User:</strong> Can browse products and place orders</li>
                                <li><strong>Admin:</strong> Full access to manage products and users</li>
                            </ul>
                        </div>

                        <!-- Current Information Display -->
                        <div class="card bg-light mb-3">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-info me-1"></i>Current User Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <small class="text-muted">Current Name:</small>
                                        <p class="mb-0">{{ $user->name }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted">Current Email:</small>
                                        <p class="mb-0">{{ $user->email }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted">Current Role:</small>
                                        <p class="mb-0">
                                            <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-success' }}">
                                                <i class="fas {{ $user->role === 'admin' ? 'fa-crown' : 'fa-user' }} me-1"></i>
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <small class="text-muted">Account Created:</small>
                                        <p class="mb-0">{{ $user->created_at->format('F d, Y g:i A') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted">Last Updated:</small>
                                        <p class="mb-0">{{ $user->updated_at->format('F d, Y g:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('users.show', $user) }}" class="btn btn-secondary me-2">
                                    <i class="fas fa-eye me-1"></i>View User
                                </a>
                                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Back to Users
                                </a>
                            </div>
                            <div>
                                <button type="reset" class="btn btn-outline-secondary me-2" onclick="resetForm()">
                                    <i class="fas fa-undo me-1"></i>Reset Changes
                                </button>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save me-1"></i>Update User
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.form-label {
    font-weight: 600;
    color: #495057;
}

.breadcrumb {
    background-color: transparent;
    padding: 0;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: ">";
    color: #6c757d;
}

.bg-light {
    background-color: #f8f9fa !important;
}
</style>

<script>
function resetForm() {
    // Reset form to original values
    document.getElementById('name').value = "{{ $user->name }}";
    document.getElementById('email').value = "{{ $user->email }}";
    document.getElementById('role').value = "{{ $user->role }}";
    
    // Remove any validation classes
    document.querySelectorAll('.is-invalid').forEach(function(element) {
        element.classList.remove('is-invalid');
    });
    
    // Remove any error messages
    document.querySelectorAll('.invalid-feedback').forEach(function(element) {
        element.remove();
    });
}

// Form change detection
let formChanged = false;
const form = document.querySelector('form');
const originalValues = {
    name: "{{ $user->name }}",
    email: "{{ $user->email }}",
    role: "{{ $user->role }}"
};

form.addEventListener('input', function(e) {
    const currentValues = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        role: document.getElementById('role').value
    };
    
    formChanged = JSON.stringify(originalValues) !== JSON.stringify(currentValues);
});

// Warn user about unsaved changes
window.addEventListener('beforeunload', function(e) {
    if (formChanged) {
        e.preventDefault();
        e.returnValue = '';
    }
});

// Don't warn when submitting the form
form.addEventListener('submit', function() {
    formChanged = false;
});
</script>
@endsection