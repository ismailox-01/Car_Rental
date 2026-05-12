<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Car Rental</title>

    <!-- Boostrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-bg: #f8fafc;
            --sidebar-bg: #1e293b;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --border-color: #e2e8f0;
        }
        [data-bs-theme="dark"] {
            --primary-bg: #0f172a;
            --sidebar-bg: #1e293b;
            --card-bg: #1e293b;
            --text-main: #f1f5f9;
            --border-color: #334155;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-main);
            transition: background-color 0.3s, color 0.3s;
        }
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: var(--sidebar-bg);
            color: white;
            z-index: 1000;
            transition: all 0.3s;
        }
        #content {
            margin-left: var(--sidebar-width);
            padding: 2.5rem;
            min-height: 100vh;
        }
        .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 0.8rem 1.5rem;
            border-radius: 0.5rem;
            margin: 0.2rem 1rem;
            font-weight: 500;
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
        }
        .nav-link.active {
            color: #38bdf8;
        }
        .nav-link i {
            width: 24px;
            font-size: 1.1rem;
        }
        .card {
            border: none;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            border-radius: 0.75rem;
            background-color: var(--card-bg);
            color: var(--text-main);
        }
        [data-bs-theme="dark"] .card {
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.2), 0 2px 4px -2px rgb(0 0 0 / 0.2);
        }
        [data-bs-theme="dark"] .bg-white {
            background-color: var(--card-bg) !important;
        }
        [data-bs-theme="dark"] .text-dark {
            color: #f1f5f9 !important;
        }
        [data-bs-theme="dark"] .border-bottom {
            border-color: var(--border-color) !important;
        }
        [data-bs-theme="dark"] .bg-light {
            background-color: rgba(255, 255, 255, 0.05) !important;
        }
        [data-bs-theme="dark"] .input-group-text, 
        [data-bs-theme="dark"] .form-control,
        [data-bs-theme="dark"] .form-select {
            background-color: rgba(255, 255, 255, 0.05) !important;
            color: #f1f5f9 !important;
            border-color: var(--border-color) !important;
        }
        [data-bs-theme="dark"] .table {
            color: #f1f5f9 !important;
        }
        [data-bs-theme="dark"] .table thead th {
            background-color: rgba(255, 255, 255, 0.1) !important;
            color: #94a3b8 !important;
        }
        [data-bs-theme="dark"] .list-group-item {
            background-color: transparent !important;
            color: #f1f5f9 !important;
            border-color: var(--border-color) !important;
        }
        [data-bs-theme="dark"] .btn-white {
            background-color: #334155 !important;
            color: white !important;
        }
        .stat-card {
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .badge {
            font-weight: 600;
            padding: 0.5em 0.8em;
        }
        @media (max-width: 992px) {
            #sidebar { left: -260px; }
            #sidebar.show { left: 0; }
            #content { margin-left: 0; }
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Sidebar -->
    <div id="sidebar" class="d-flex flex-column">
        <div class="p-4 border-bottom border-secondary mb-3">
            <h5 class="fw-bold mb-0 text-white"><i class="bi bi-speedometer2 me-2"></i>AdminPanel</h5>
        </div>
        
        <ul class="nav flex-column flex-grow-1">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-house-door me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.cars.*') ? 'active' : '' }}" href="{{ route('admin.cars.index') }}">
                    <i class="bi bi-car-front me-2"></i> Manage Cars
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}" href="{{ route('admin.bookings.index') }}">
                    <i class="bi bi-calendar-check me-2"></i> Bookings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="bi bi-people me-2"></i> Customers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.locations.*') ? 'active' : '' }}" href="{{ route('admin.locations.index') }}">
                    <i class="bi bi-geo-alt me-2"></i> Locations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
                    <i class="bi bi-chat-left-text me-2"></i> Messages
                </a>
            </li>
            <li class="nav-item mt-auto border-top border-secondary pt-3">
                <a class="nav-link text-warning" href="{{ route('home') }}" target="_blank">
                    <i class="bi bi-arrow-up-right-square me-2"></i> View Website
                </a>
            </li>
            <li class="nav-item mb-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link bg-transparent border-0 w-100 text-start text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div id="content">
        <!-- Top Header -->
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h4 class="fw-bold mb-1">@yield('page_title', 'Dashboard')</h4>
                <p class="text-muted small mb-0">{{ now()->format('l, d F Y') }}</p>
            </div>
            <div class="d-flex align-items-center">
                <!-- Theme Toggle -->
                <button id="themeToggle" class="btn btn-white bg-white shadow-sm border-0 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="bi bi-moon-stars fs-5"></i>
                </button>

                <div class="dropdown">
                    <button class="btn btn-white bg-white dropdown-toggle shadow-sm border-0 d-flex align-items-center" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=1e293b&color=fff" class="rounded-circle me-2" width="32" height="32">
                        <span class="fw-bold small">{{ auth()->user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                        <li><a class="dropdown-item py-2" href="#"><i class="bi bi-person me-2"></i>My Profile</a></li>
                        <li><a class="dropdown-item py-2" href="#"><i class="bi bi-calendar me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const html = document.documentElement;
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = themeToggle.querySelector('i');
            
            // Load saved theme or system preference
            const savedTheme = localStorage.getItem('admin-theme');
            const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            const setTheme = (theme) => {
                html.setAttribute('data-bs-theme', theme);
                localStorage.setItem('admin-theme', theme);
                
                if (theme === 'dark') {
                    themeIcon.classList.replace('bi-moon-stars', 'bi-sun');
                } else {
                    themeIcon.classList.replace('bi-sun', 'bi-moon-stars');
                }
            };

            // Initialize
            if (savedTheme) {
                setTheme(savedTheme);
            } else if (systemPrefersDark) {
                setTheme('dark');
            }

            // Toggle click event
            themeToggle.addEventListener('click', () => {
                const currentTheme = html.getAttribute('data-bs-theme');
                setTheme(currentTheme === 'dark' ? 'light' : 'dark');
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
