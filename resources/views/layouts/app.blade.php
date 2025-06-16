<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'VOIDGame')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #6f42c1;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --info-color: #0dcaf0;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --cream-bg: #f8f6f0;
            --warm-brown: #8b4513;
        }

        body {
            background-color: var(--cream-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

/* Enhanced Navbar Styling */
.navbar-custom {
    background: linear-gradient(135deg, #6f42c1, #5a32a3);
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
    border-bottom: 3px solid #5a32a3;
}

.navbar-brand {
    font-weight: 700;
    font-size: 1.6rem;
    color: white !important;
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

/* Avatar Circle */
.avatar-circle-sm {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: linear-gradient(45deg, #6f42c1, #5a32a3);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 12px;
}

/* Dropdown Menu */
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

/* Search Bar */
.input-group .form-control {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.input-group .btn {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

/* Cart Badge */
.badge {
    font-size: 0.6rem;
    padding: 0.25rem 0.4rem;
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .navbar-nav {
        padding-top: 1rem;
    }
    
    .nav-item {
        margin-bottom: 0.5rem;
    }
    
    .dropdown-menu {
        margin-left: 1rem;
        width: calc(100% - 2rem);
    }
}
        /* Card Enhancements */
        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
            transform: translateY(-2px);
        }

        /* Custom Buttons */
        .btn {
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), #5a32a3);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #5a32a3, var(--primary-color));
            transform: translateY(-1px);
        }

        /* Footer */
        .footer-custom {
            background: linear-gradient(135deg, var(--dark-color), #495057);
            color: white;
        }

        /* Alert Improvements */
        .alert {
            border: none;
            border-radius: 0.75rem;
            border-left: 4px solid;
        }

        .alert-success {
            border-left-color: var(--success-color);
        }

        .alert-danger {
            border-left-color: var(--danger-color);
        }

        .alert-warning {
            border-left-color: var(--warning-color);
        }

        .alert-info {
            border-left-color: var(--info-color);
        }

        /* Form Enhancements */
        .form-control, .form-select {
            border-radius: 0.5rem;
            border: 1px solid #dee2e6;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
        }

        /* Breadcrumb */
        .breadcrumb {
            background: none;
            margin-bottom: 1.5rem;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
            color: var(--secondary-color);
        }

        /* Responsive utilities */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.25rem;
            }
            
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        /* Loading spinner */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }
    </style>

    {{-- Additional styles --}}
    @stack('styles')
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <i class="bi bi-shop me-2"></i>
            <span class="fw-bold">VOIDGame</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        <i class="bi bi-house-door me-1"></i>Home
                    </a>
                </li>

                <!-- Products Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('products*') ? 'active' : '' }}"
                       href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-box-seam me-1"></i>Products
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                                <i class="bi bi-collection me-2"></i>All Products
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-tags me-2"></i>Categories
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-stars me-2"></i>Featured
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Special Offers -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('offers*') ? 'active' : '' }}" href="#">
                        <i class="bi bi-percent me-1"></i>Special Offers
                    </a>
                </li>

                @auth
                    @if (auth()->user()->role === 'admin')
                        <!-- Admin Dashboard Link -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin*') ? 'active' : '' }}"
                               href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i>Admin Panel
                            </a>
                        </li>
                    @else
                        <!-- My Orders -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('user/order*') ? 'active' : '' }}"
                               href="{{ route('user.order.index') }}">
                                <i class="bi bi-bag me-1"></i>My Orders
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>

            <ul class="navbar-nav">
                <!-- Search Bar -->
                <li class="nav-item me-2">
                    <form class="d-flex" action="{{ route('products.search') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="query" placeholder="Search products..." value="{{ request('query') }}">
                            <button class="btn btn-light" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </li>

                <!-- Cart with Dynamic Count -->
                @php
                    $cartCount = 0;
                    if(auth()->check()) {
                        // Tambahkan pengecekan method_exists
                        if(method_exists(auth()->user(), 'cartItems')) {
                            $cartCount = auth()->user()->cartItems()->count();
                        }
                    } elseif(session()->has('cart')) {
                        $cartCount = count(session('cart'));
                    }
                @endphp
                <li class="nav-item me-2">
                    <a class="nav-link position-relative" href="{{ auth()->check() ? route('user.order.index') : route('login') }}">
                        <i class="bi bi-cart3"></i>
                        @if($cartCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $cartCount }}
                        </span>
                        @endif
                    </a>
                </li>

                @auth
                    <!-- User Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                           data-bs-toggle="dropdown">
                            <div class="avatar-circle-sm me-2">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>
                            {{ auth()->user()->name }}
                        </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-person me-2"></i>Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-heart me-2"></i>Wishlist
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-gear me-2"></i>Settings
                                    </a>
                                </li>
                                @if(auth()->user()->role === 'admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
                                    </a>
                                </li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                    </li>
                @else
                    <!-- Login/Register -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Login
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-outline-light {{ request()->is('register') ? 'active' : '' }}" href="{{ route('register') }}">
                            <i class="bi bi-person-plus me-1"></i>Register
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

    <!-- Flash Messages -->
    @if(session('success') || session('error') || session('warning') || session('info'))
        <div class="container mt-3">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle me-2"></i>{{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    @endif

    <!-- Breadcrumb -->
    @hasSection('breadcrumb')
        <div class="container mt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @yield('breadcrumb')
                </ol>
            </nav>
        </div>
    @endif

    <!-- Main Content -->
    <main class="@yield('main-class', 'container') @yield('main-spacing', 'my-4')">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-custom mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">VOIDGame</h5>
                    <p class="mb-2">Your trusted online store for quality products.</p>
                    <div class="d-flex">
                        <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="mb-3">Quick Links</h6>
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white-50 text-decoration-none">About Us</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none">Contact</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none">Privacy Policy</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <h6 class="mb-3">Support</h6>
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white-50 text-decoration-none">Help Center</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none">FAQ</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none">Terms of Service</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2025 VOIDGame. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <small class="text-white-50">Built with ❤️ using Laravel & Bootstrap</small>
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
                if (submitBtn) {
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

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>

    {{-- Additional scripts --}}
    @stack('scripts')
</body>
</html>