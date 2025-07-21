@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Welcome Header -->
    <div class="row mb-5 align-items-center">
        <div class="col-md-8">
            <h1 class="display-4 mb-3">Welcome, Admin!</h1>
            <p class="lead text-muted">What would you like to manage today?</p>
        </div>
        <div class="col-md-4 text-md-end">
            <div class="avatar-circle-lg">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
        </div>
    </div>

    <!-- Navigation Cards -->
    <div class="row g-4">
        <!-- Users Card -->
        <div class="col-lg-4 col-md-6">
            <div class="card nav-card bg-gradient-users">
                <div class="card-body text-center p-4">
                    <div class="nav-icon mb-3">
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                    <h3 class="card-title mb-3">User Management</h3>
                    <p class="card-text mb-4">Manage all system users</p>
                    <a href="{{ route('users.index') }}" class="btn btn-light btn-rounded">
                        Go to Users <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Products Card -->
        <div class="col-lg-4 col-md-6">
            <div class="card nav-card bg-gradient-products">
                <div class="card-body text-center p-4">
                    <div class="nav-icon mb-3">
                        <i class="fas fa-box-open fa-3x"></i>
                    </div>
                    <h3 class="card-title mb-3">Product Management</h3>
                    <p class="card-text mb-4">Manage your product catalog</p>
                    <a href="{{ route('products.index') }}" class="btn btn-light btn-rounded">
                        Go to Products <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Reviews Card -->
        <div class="col-lg-4 col-md-6">
            <div class="card nav-card bg-gradient-reviews">
                <div class="card-body text-center p-4">
                    <div class="nav-icon mb-3">
                        <i class="fas fa-star fa-3x"></i>
                    </div>
                    <h3 class="card-title mb-3">Review Management</h3>
                    <p class="card-text mb-4">Manage product reviews</p>
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-light btn-rounded">
                        Go to Reviews <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Categories Card -->
        <div class="col-lg-4 col-md-6">
            <div class="card nav-card bg-gradient-categories">
                <div class="card-body text-center p-4">
                    <div class="nav-icon mb-3">
                        <i class="fas fa-list fa-3x"></i>
                    </div>
                    <h3 class="card-title mb-3">Category Management</h3>
                    <p class="card-text mb-4">Manage product categories</p>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light btn-rounded">
                        Go to Categories <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Types Card -->
        <div class="col-lg-4 col-md-6">
            <div class="card nav-card bg-gradient-categories">
                <div class="card-body text-center p-4">
                    <div class="nav-icon mb-3">
                        <i class="fas fa-list fa-3x"></i>
                    </div>
                    <h3 class="card-title mb-3">Category Management</h3>
                    <p class="card-text mb-4">Manage product categories and types</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-light btn-rounded">
                            Categories <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics Card -->
        <div class="col-lg-4 col-md-6">
            <div class="card nav-card bg-gradient-analytics">
                <div class="card-body text-center p-4">
                    <div class="nav-icon mb-3">
                        <i class="fas fa-chart-line fa-3x"></i>
                    </div>
                    <h3 class="card-title mb-3">Analytics Dashboard</h3>
                    <p class="card-text mb-4">View store analytics</p>
                    <a href="{{ route('admin.analytics.dashboard') }}" class="btn btn-light btn-rounded">
                        Go to Analytics <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Base Card Styles */
.nav-card {
    border: none;
    border-radius: 1rem;
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
    color: white;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
}

.nav-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 2rem rgba(0,0,0,0.15);
}

/* Gradient Backgrounds */
.bg-gradient-users {
    background: linear-gradient(135deg, #6f42c1, #8a63d2);
}

.bg-gradient-products {
    background: linear-gradient(135deg, #20c997, #3dd9af);
}

.bg-gradient-reviews {
    background: linear-gradient(135deg, #fd7e14, #ff9737);
}

.bg-gradient-analytics {
    background: linear-gradient(135deg, #6610f2, #7e3af2);
}

/* Avatar Circle */
.avatar-circle-lg {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(45deg, #6f42c1, #5a32a3);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 24px;
    box-shadow: 0 0.5rem 1rem rgba(111, 66, 193, 0.3);
}

/* Button Styles */
.btn-rounded {
    border-radius: 50px;
    padding: 0.5rem 1.5rem;
    font-weight: 500;
    border: none;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
.bg-gradient-categories {
    background: linear-gradient(135deg, #17a2b8, #2fc5d8);
}
</style>
@endsection