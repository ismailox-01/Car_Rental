<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">
            <i class="bi bi-car-front-fill me-2"></i>CAR<span class="text-theme-dark">RENTAL</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active text-primary fw-bold' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cars.index') ? 'active text-primary fw-bold' : '' }}" href="{{ route('cars.index') }}">Browse Cars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active text-primary fw-bold' : '' }}" href="{{ route('about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active text-primary fw-bold' : '' }}" href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <!-- Theme Toggle -->
                <button id="themeToggle" class="btn btn-link text-dark text-decoration-none p-0 me-3 d-flex align-items-center" title="Toggle Theme">
                    <i class="bi bi-moon-stars fs-5"></i>
                </button>

                @auth
                    <div class="dropdown">
                        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            @if(auth()->user()->isAdmin())
                                <li><a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Admin Panel</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li><a class="dropdown-item py-2" href="{{ route('profile.show') }}"><i class="bi bi-person me-2"></i>My Profile</a></li>
                            <li><a class="dropdown-item py-2" href="{{ route('bookings.history') }}"><i class="bi bi-calendar-check me-2"></i>My Bookings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-link text-dark text-decoration-none me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary px-4 rounded-pill shadow-sm">Sign Up</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
