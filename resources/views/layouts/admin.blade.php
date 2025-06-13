<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #F8F3D9;
            color: #504B38;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(135deg, #B9B28A 0%, #A5A077 100%) !important;
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(80, 75, 56, 0.15);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(248, 243, 217, 0.1);
            animation: fadeInDown 0.6s ease-out;
        }

        /* Container with proper spacing */
        .navbar .container {
            max-width: 100%;
            padding-left: 30px; /* Increased from default to give more space */
            padding-right: 30px; /* Increased from default to give more space */
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .navbar-brand {
            color: #F8F3D9 !important;
            font-weight: 700;
            font-size: 1.8rem;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-left: 10px; /* Added margin to move brand slightly right */
        }

        .navbar-brand::before {
            content: '\f0e4';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 1.2rem;
            background: linear-gradient(45deg, #F8F3D9, #EBE5C2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-brand:hover {
            color: #EBE5C2 !important;
            transform: scale(1.05);
        }

        .nav-link {
            color: #F8F3D9 !important;
            padding: 0.75rem 1.5rem !important;
            border-radius: 12px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600;
            margin: 0 0.3rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
            background: linear-gradient(45deg, transparent 50%, rgba(235, 229, 194, 0.1) 50%);
            background-size: 200% 200%;
            background-position: 100% 100%;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(235, 229, 194, 0.3), transparent);
            transition: left 0.6s;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link:hover,
        .nav-link:focus {
            background: linear-gradient(135deg, #EBE5C2 0%, #DDD6B8 100%) !important;
            color: #504B38 !important;
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 8px 25px rgba(80, 75, 56, 0.2);
            background-position: 0% 0%;
        }

        .nav-link:active {
            transform: translateY(0) scale(0.98);
        }

        /* Add icons to nav links */
        .nav-link[href*="products"]::after {
            content: '\f468';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 0.9rem;
        }

        .nav-link[href*="users"]::after {
            content: '\f0c0';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 0.9rem;
        }

        /* Navbar toggler styling */
        .navbar-toggler {
            border: 2px solid #F8F3D9;
            padding: 0.4rem 0.6rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: rgba(248, 243, 217, 0.1);
            margin-right: 10px; /* Added margin to move toggler slightly left */
        }

        .navbar-toggler:hover {
            background: rgba(248, 243, 217, 0.2);
            border-color: #EBE5C2;
            transform: scale(1.05);
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.25rem rgba(248, 243, 217, 0.3);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28248, 243, 217, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2.5' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            transition: all 0.3s ease;
        }

        /* Desktop navigation */
        @media (min-width: 992px) {
            .navbar-nav {
                margin-right: 10px !important; /* Added margin to move nav items slightly left */
            }

            .nav-menu-container {
                display: flex !important;
                align-items: center;
                gap: 0.2rem;
                background: rgba(248, 243, 217, 0.05);
                padding: 0.5rem;
                border-radius: 16px;
                backdrop-filter: blur(5px);
            }

            .logout-btn {
                background: linear-gradient(45deg, transparent 50%, rgba(235, 229, 194, 0.1) 50%) !important;
                background-size: 200% 200%;
                background-position: 100% 100%;
                border: none !important;
                color: #F8F3D9 !important;
                padding: 0.75rem 1.5rem !important;
                border-radius: 12px;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                font-weight: 600;
                margin: 0 0.3rem;
                cursor: pointer;
                position: relative;
                overflow: hidden;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
            }

            .logout-btn::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(235, 229, 194, 0.3), transparent);
                transition: left 0.6s;
            }

            .logout-btn::after {
                content: '\f2f5';
                font-family: 'Font Awesome 6 Free';
                font-weight: 900;
                font-size: 0.9rem;
            }

            .logout-btn:hover::before {
                left: 100%;
            }

            .logout-btn:hover,
            .logout-btn:focus {
                background: linear-gradient(135deg, #EBE5C2 0%, #DDD6B8 100%) !important;
                color: #504B38 !important;
                transform: translateY(-2px) scale(1.02);
                box-shadow: 0 8px 25px rgba(80, 75, 56, 0.2);
                background-position: 0% 0%;
            }

            .logout-btn:active {
                transform: translateY(0) scale(0.98);
            }
        }

        /* Mobile menu styling */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: linear-gradient(135deg, #B9B28A 0%, #A5A077 100%);
                margin-top: 1rem;
                padding: 2rem;
                border-radius: 20px;
                box-shadow: 0 20px 40px rgba(80, 75, 56, 0.3);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(248, 243, 217, 0.2);
                animation: slideDown 0.3s ease-out;
            }

            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .navbar-nav {
                gap: 0.8rem;
            }

            .nav-item {
                width: 100%;
            }

            .nav-link {
                padding: 1rem 1.5rem !important;
                text-align: left;
                display: flex !important;
                align-items: center;
                justify-content: space-between;
                width: 100%;
                margin: 0;
                border-radius: 12px;
                background: rgba(248, 243, 217, 0.1);
                border: 1px solid rgba(248, 243, 217, 0.2);
                backdrop-filter: blur(5px);
            }

            .nav-link:hover,
            .nav-link:focus {
                background: linear-gradient(135deg, #EBE5C2 0%, #DDD6B8 100%) !important;
                color: #504B38 !important;
                transform: translateX(8px) scale(1.02);
                box-shadow: 0 8px 25px rgba(80, 75, 56, 0.25);
            }

            .logout-btn {
                width: 100% !important;
                text-align: left !important;
                padding: 1rem 1.5rem !important;
                background: rgba(248, 243, 217, 0.1) !important;
                border: 1px solid rgba(248, 243, 217, 0.2) !important;
                color: #F8F3D9 !important;
                border-radius: 12px;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                font-weight: 600;
                cursor: pointer;
                backdrop-filter: blur(5px);
                display: flex !important;
                align-items: center;
                justify-content: space-between;
            }

            .logout-btn::after {
                content: '\f2f5';
                font-family: 'Font Awesome 6 Free';
                font-weight: 900;
                font-size: 0.9rem;
            }

            .logout-btn:hover,
            .logout-btn:focus {
                background: linear-gradient(135deg, #EBE5C2 0%, #DDD6B8 100%) !important;
                color: #504B38 !important;
                transform: translateX(8px) scale(1.02);
                box-shadow: 0 8px 25px rgba(80, 75, 56, 0.25);
            }
        }

        main {
            flex: 1;
        }

        footer {
            background: linear-gradient(135deg, #504B38 0%, #3F392B 100%);
            color: #F8F3D9;
            padding: 2rem 0;
            box-shadow: 0 -4px 20px rgba(80, 75, 56, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #504B38 0%, #3F392B 100%);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(80, 75, 56, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #B9B28A 0%, #A5A077 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(80, 75, 56, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #FFC107 0%, #FFB300 100%);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #FFCA28 0%, #FFC107 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #E53935 0%, #C62828 100%);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(229, 57, 53, 0.3);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #F44336 0%, #E53935 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(229, 57, 53, 0.4);
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .navbar {
                font-size: 0.9rem;
                padding: 0.75rem 0;
            }

            .navbar-brand {
                font-size: 1.6rem;
            }

            footer {
                font-size: 0.85rem;
                padding: 1.5rem 0;
            }
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.4rem;
                margin-left: 5px; /* Smaller margin for mobile */
            }

            .navbar-toggler {
                margin-right: 5px; /* Smaller margin for mobile */
            }

            .nav-link {
                font-size: 0.9rem;
                padding: 0.8rem 1.2rem !important;
            }

            footer {
                font-size: 0.8rem;
                padding: 1.2rem 0;
            }

            .navbar-collapse {
                padding: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.2rem;
            }

            .navbar .container {
                padding-left: 20px; /* Slightly more padding for mobile */
                padding-right: 20px;
            }

            .navbar-collapse {
                padding: 1rem;
            }
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('products.index') }}">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Manage Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <footer class="text-center">
        <div class="container">
            <p class="mb-0">&copy; 2025 Your Store. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>