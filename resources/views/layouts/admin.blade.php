<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard - Project Store')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom CSS -->
    <style>
        :root {
            --admin-primary: #6f42c1;
            --admin-secondary: #6c757d;
            --admin-success: #198754;
            --admin-info: #0dcaf0;
            --admin-warning: #ffc107;
            --admin-danger: #dc3545;
            --admin-light: #f8f9fa;
            --admin-dark: #212529;
            --admin-cream: #f8f6f0;
        }
        
        body {
            background-color: var(--admin-cream);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        /* Admin Navbar Styling */
        .navbar-admin {
            background: linear-gradient(135deg, var(--admin-primary), #5a32a3);
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            border-bottom: 3px solid #5a32a3;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.6rem;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .navbar-brand .bi {
            font-size: 1.4rem;
        }
        
        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            margin: 0 0.25rem;
            padding: 0.75rem 1rem !important;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .navbar-nav .nav-link:hover {
            background-color: rgba(255,255,255,0.15);
            color: white !important;
            transform: translateY(-1px);
        }
        
        .navbar-nav .nav-link.active {
            background-color: rgba(255,255,255,0.2);
            color: white !important;
        }
        
        /* Logout button styling */
        .logout-btn {
            background: rgba(255,255,255,0.1) !important;
            border: 1px solid rgba(255,255,255,0.3) !important;
            color: white !important;
            font-weight: 500;
            padding: 0.75rem 1rem !important;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .logout-btn:hover {
            background: rgba(255,255,255,0.2) !important;
            border-color: rgba(255,255,255,0.5) !important;
            transform: translateY(-1px);
        }
        
        /* Main content area */
        main {
            flex: 1;
            padding: 2rem 0;
        }
        
        /* Admin page header */
        .admin-header {
            background: linear-gradient(135deg, white, #f8f9fa);
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
            border-left: 4px solid var(--admin-primary);
        }
        
        .admin-header h1 {
            color: var(--admin-primary);
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        /* Card enhancements */
        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
            transform: translateY(-2px);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--admin-primary), #5a32a3);
            color: white;
            border: none;
            font-weight: 600;
        }
        
        /* Table styling */
        .table {
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        }
        
        .table thead th {
            background: linear-gradient(135deg, var(--admin-primary), #5a32a3);
            color: white;
            border: none;
            font-weight: 600;
            padding: 1rem;
        }
        
        .table tbody tr {
            transition: all 0.2s ease;
        }
        
        .table tbody tr:hover {
            background-color: rgba(111, 66, 193, 0.05);
        }
        
        .table td {
            padding: 1rem;
            vertical-align: middle;
        }
        
        /* Button styling */
        .btn {
            border-radius: 0.5rem;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn:hover {
            transform: translateY(-1px);
        }
        
        .btn-primary {
            background: linear-gradient(45deg, var(--admin-primary), #5a32a3);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(45deg, #5a32a3, var(--admin-primary));
            box-shadow: 0 0.25rem 0.5rem rgba(111, 66, 193, 0.3);
        }
        
        .btn-success {
            background: linear-gradient(45deg, var(--admin-success), #146c43);
            border: none;
        }
        
        .btn-success:hover {
            background: linear-gradient(45deg, #146c43, var(--admin-success));
            box-shadow: 0 0.25rem 0.5rem rgba(25, 135, 84, 0.3);
        }
        
        .btn-warning {
            background: linear-gradient(45deg, var(--admin-warning), #e0a800);
            border: none;
            color: #000;
        }
        
        .btn-warning:hover {
            background: linear-gradient(45deg, #e0a800, var(--admin-warning));
            box-shadow: 0 0.25rem 0.5rem rgba(255, 193, 7, 0.3);
            color: #000;
        }
        
        .btn-danger {
            background: linear-gradient(45deg, var(--admin-danger), #b02a37);
            border: none;
        }
        
        .btn-danger:hover {
            background: linear-gradient(45deg, #b02a37, var(--admin-danger));
            box-shadow: 0 0.25rem 0.5rem rgba(220, 53, 69, 0.3);
        }
        
        .btn-info {
            background: linear-gradient(45deg, var(--admin-info), #0aa1c0);
            border: none;
        }
        
        .btn-info:hover {
            background: linear-gradient(45deg, #0aa1c0, var(--admin-info));
            box-shadow: 0 0.25rem 0.5rem rgba(13, 202, 240, 0.3);
        }
        
        /* Alert styling */
        .alert {
            border: none;
            border-radius: 0.75rem;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-left: 4px solid;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #d1eddd, #a3cfbb);
            border-left-color: var(--admin-success);
            color: #0f5132;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f1aeb5);
            border-left-color: var(--admin-danger);
            color: #721c24;
        }
        
        .alert-warning {
            background: linear-gradient(135deg, #fff3cd, #ffecb5);
            border-left-color: var(--admin-warning);
            color: #664d03;
        }
        
        .alert-info {
            background: linear-gradient(135deg, #d1ecf1, #b6d7ff);
            border-left-color: var(--admin-info);
            color: #055160;
        }
        
        /* Avatar circle for user tables */
        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--admin-primary), #5a32a3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }
        
        /* Badge styling */
        .badge {
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
        }
        
        /* Empty state styling */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--admin-secondary);
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            opacity: 0.5;
        }
        
        .empty-state h3 {
            color: var(--admin-dark);
            margin-bottom: 1rem;
        }
        
        /* Footer styling */
        footer {
            background: linear-gradient(135deg, var(--admin-dark), #495057);
            color: white;
            padding: 2rem 0;
            margin-top: auto;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.3rem;
            }
            
            .admin-header {
                padding: 1.5rem;
                text-align: center;
            }
            
            .admin-header h1 {
                font-size: 1.5rem;
                justify-content: center;
            }
            
            .btn-group .btn {
                padding: 0.5rem;
                margin: 0.1rem;
            }
            
            .table-responsive {
                border-radius: 0.75rem;
            }
        }
        
        /* Loading spinner */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }
        
        /* Modal enhancements */
        .modal-content {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 1rem 3rem rgba(0,0,0,0.175);
        }
        
        .modal-header {
            border-bottom: 1px solid #dee2e6;
            border-radius: 1rem 1rem 0 0;
        }
        
        .modal-footer {
            border-top: 1px solid #dee2e6;
            border-radius: 0 0 1rem 1rem;
        }

        /* Dropdown menu styling */
.dropdown-menu {
    border: none;
    border-radius: 0.75rem;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
    padding: 0.5rem;
    margin-top: 0.5rem;
}

.dropdown-item {
    border-radius: 0.5rem;
    padding: 0.5rem 1rem;
    margin: 0.15rem 0;
    transition: all 0.2s ease;
}

.dropdown-item:hover {
    background-color: rgba(111, 66, 193, 0.1);
}

.dropdown-item:active {
    background-color: var(--admin-primary);
}

/* User dropdown styling */
.navbar-nav .dropdown-menu {
    min-width: 200px;
}

/* Active dropdown toggle */
.nav-link.dropdown-toggle.active {
    background-color: rgba(255,255,255,0.2);
}
    </style>
    @stack('styles')
</head>
<body>
    <!-- Admin Navigation -->
<nav class="navbar navbar-expand-lg navbar-admin sticky-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2"></i>
            Admin Panel
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-house-door"></i>
                        Dashboard
                    </a>
                </li>
                
                <!-- Products -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('products.*') ? 'active' : '' }}" 
                       href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-box-seam"></i>
                        Products
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('products.index') }}">
                                <i class="bi bi-list-ul me-2"></i>All Products
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('product.create') }}">
                                <i class="bi bi-plus-circle me-2"></i>Add New
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-tags me-2"></i>Categories
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Users -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('users.*') ? 'active' : '' }}" 
                       href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-people"></i>
                        Users
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('users.index') }}">
                                <i class="bi bi-list-ul me-2"></i>All Users
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('users.create') }}">
                                <i class="bi bi-person-plus me-2"></i>Add New
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-shield-lock me-2"></i>Roles
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Reviews -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}"
                       href="{{ route('admin.reviews.index') }}">
                        <i class="bi bi-star"></i>
                        Reviews
                    </a>
                </li>
                
                <!-- Analytics -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}"
                       href="{{ route('admin.analytics.dashboard') }}">
                        <i class="bi bi-graph-up"></i>
                        Analytics
                    </a>
                </li>
            </ul>
            
            <ul class="navbar-nav">
                <!-- Store Front -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}" target="_blank">
                        <i class="bi bi-shop"></i>
                        View Store
                    </a>
                </li>
                
                <!-- User Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i>
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-person me-2"></i>Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-gear me-2"></i>Settings
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Flash Messages -->
    @if(session('success') || session('error') || session('warning') || session('info'))
        <div class="container-fluid px-4 mt-3">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle-fill"></i>
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    @endif

    <!-- Main Content -->
    <main class="@yield('main-class', 'container-fluid px-4')">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-md-start">
                    <p class="mb-0">&copy; 2025 Project Store Admin. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <small class="text-light">Built with ❤️ using Laravel & Bootstrap</small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });

        // Add loading state to forms
        document.querySelectorAll('form').forEach(function(form) {
            form.addEventListener('submit', function() {
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn && !submitBtn.hasAttribute('data-no-loading')) {
                    submitBtn.disabled = true;
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Loading...';
                    
                    // Re-enable after 3 seconds as fallback
                    setTimeout(function() {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    }, 3000);
                }
            });
        });

        // Confirmation dialogs for delete actions
        function confirmDelete(message = 'Are you sure you want to delete this item?') {
            return confirm(message);
        }
    </script>
    
    @stack('scripts')
</body>
</html>