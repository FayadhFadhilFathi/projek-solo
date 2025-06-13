@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
            <li class="breadcrumb-item active">{{ $user->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-4">
            <!-- User Profile Card -->
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <div class="avatar-lg bg-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                        <span class="text-white display-6">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    </div>
                    <h4 class="card-title mb-2">{{ $user->name }}</h4>
                    <p class="text-muted mb-3">{{ $user->email }}</p>
                    <span class="badge fs-6 {{ $user->role === 'admin' ? 'bg-danger' : 'bg-success' }} mb-3">
                        <i class="fas {{ $user->role === 'admin' ? 'fa-crown' : 'fa-user' }} me-1"></i>
                        {{ ucfirst($user->role) }}
                    </span>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i>Edit User
                        </a>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                            <i class="fas fa-trash me-1"></i>Delete User
                        </button>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Card -->
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Quick Stats</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-12 mb-3">
                            <div class="border-bottom pb-2">
                                <h5 class="text-primary mb-1">{{ $user->created_at->diffForHumans() }}</h5>
                                <small class="text-muted">Member Since</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h5 class="text-success mb-1">Active</h5>
                            <small class="text-muted">Status</small>
                        </div>
                        <div class="col-6">
                            <h5 class="text-info mb-1">{{ $user->role === 'admin' ? 'Full' : 'Limited' }}</h5>
                            <small class="text-muted">Access</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- User Details Card -->
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>User Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <label class="form-label text-muted">
                                    <i class="fas fa-user me-1"></i>Full Name
                                </label>
                                <p class="fs-5 mb-0">{{ $user->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <label class="form-label text-muted">
                                    <i class="fas fa-envelope me-1"></i>Email Address
                                </label>
                                <p class="fs-5 mb-0">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <label class="form-label text-muted">
                                    <i class="fas fa-shield-alt me-1"></i>Role
                                </label>
                                <p class="fs-5 mb-0">
                                    <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-success' }}">
                                        <i class="fas {{ $user->role === 'admin' ? 'fa-crown' : 'fa-user' }} me-1"></i>
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <label class="form-label text-muted">
                                    <i class="fas fa-calendar-plus me-1"></i>Account Created
                                </label>
                                <p class="fs-5 mb-0">{{ $user->created_at->format('F d, Y') }}</p>
                                <small class="text-muted">{{ $user->created_at->format('g:i A') }}</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <label class="form-label text-muted">
                                    <i class="fas fa-edit me-1"></i>Last Updated
                                </label>
                                <p class="fs-5 mb-0">{{ $user->updated_at->format('F d, Y') }}</p>
                                <small class="text-muted">{{ $user->updated_at->format('g:i A') }}</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <label class="form-label text-muted">
                                    <i class="fas fa-key me-1"></i>User ID
                                </label>
                                <p class="fs-5 mb-0">#{{ $user->id }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Permissions Card -->
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-lock me-2"></i>Permissions & Access</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($user->role === 'admin')
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Manage Products</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Manage Users</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>View All Orders</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Access Admin Dashboard</span>
                                </div>
                            </div>
                        @else
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Browse Products</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Place Orders</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-times-circle text-danger me-2"></i>
                                    <span>Manage Products</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-times-circle text-danger me-2"></i>
                                    <span>Manage Users</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-between">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back to Users
                </a>
                <div>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit me-1"></i>Edit User
                    </a>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                        <i class="fas fa-trash me-1"></i>Delete User
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Confirm Delete</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete user <strong>{{ $user->name }}</strong>?</p>
                <p class="text-muted">This action cannot be undone and will permanently remove:</p>
                <ul>
                    <li>User account information</li>
                    <li>Associated orders and data</li>
                    <li>User permissions and access</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-lg {
    width: 100px;
    height: 100px;
    font-size: 2.5rem;
}

.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.info-item {
    border-left: 3px solid #007bff;
    padding-left: 15px;
}

.breadcrumb {
    background-color: transparent;
    padding: 0;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: ">";
    color: #6c757d;
}
</style>

<script>
function confirmDelete() {
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}
</script>
@endsection