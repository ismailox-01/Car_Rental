<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Car Rental') }} - @yield('title', 'Drive Your Dream')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- GSAP & ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <style>
        :root {
            --primary-color: #0f172a;       /* Deep Obsidian */
            --secondary-color: #1e293b;     /* Dark Slate */
            --accent-color: #d4af37;        /* Champagne Gold */
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #334155;
            --navbar-bg: rgba(255, 255, 255, 0.95);
            --transition-speed: 0.3s;
        }

        [data-bs-theme="dark"] {
            --primary-color: #020617;
            --secondary-color: #0f172a;
            --light-bg: #020617;
            --card-bg: #0f172a;
            --text-main: #94a3b8;
            --navbar-bg: rgba(15, 23, 42, 0.9);
        }
        
        body {
            font-family: 'Outfit', sans-serif;
            color: var(--text-main);
            background-color: var(--light-bg);
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        .text-primary { color: var(--accent-color) !important; }
        .bg-primary { background-color: var(--primary-color) !important; color: white; }
        .bg-dark { background-color: var(--secondary-color) !important; }
        
        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: #000;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 10px 24px;
            transition: all var(--transition-speed) ease;
        }
        
        .btn-primary:hover {
            background-color: #bfa02b;
            border-color: #bfa02b;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
        }
        
        .btn-dark {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-dark:hover {
            background-color: #000;
            border-color: #000;
            transform: translateY(-2px);
        }

        .navbar {
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            background: var(--navbar-bg) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(212, 175, 55, 0.2);
            transition: background 0.3s ease;
        }
        
        [data-bs-theme="dark"] .navbar .nav-link {
            color: #cbd5e1 !important;
        }
        
        [data-bs-theme="dark"] .navbar .navbar-brand span {
            color: #f8fafc !important;
        }
        
        .nav-link {
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            position: relative;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: var(--accent-color);
            transition: all var(--transition-speed) ease;
            transform: translateX(-50%);
        }
        
        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
        }
        
        .navbar-brand {
            font-family: 'Outfit', sans-serif;
            letter-spacing: 2px;
        }

        .card {
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-radius: 1rem;
            overflow: hidden;
            background: var(--card-bg);
            color: var(--text-main);
        }
        
        [data-bs-theme="dark"] .text-dark {
            color: #f1f5f9 !important;
        }
        
        [data-bs-theme="dark"] .bg-white {
            background-color: var(--card-bg) !important;
        }
        
        [data-bs-theme="dark"] .bg-light {
            background-color: rgba(255, 255, 255, 0.03) !important;
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .badge {
            font-weight: 600;
            letter-spacing: 1px;
            padding: 0.5em 1em;
        }

        /* Glassmorphism utilities */
        .glass-panel {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Initial GSAP States to prevent FOUC */
        .gsap-fade-up { opacity: 0; transform: translateY(30px); }
        .gsap-scale-up { opacity: 0; transform: scale(0.9); }
        .gsap-reveal-left { opacity: 0; transform: translateX(-50px); }
        .gsap-reveal-right { opacity: 0; transform: translateX(50px); }

        /* Theme-Aware Global Overrides */
        :root {
            --brand-text-dark: #1e293b;
        }
        [data-bs-theme="dark"] {
            --brand-text-dark: #f8fafc;
        }
        .text-theme-dark { color: var(--brand-text-dark) !important; transition: color 0.3s ease; }
    </style>
    <script>
        (function() {
            const savedTheme = localStorage.getItem('admin-theme');
            const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const theme = savedTheme || (systemPrefersDark ? 'dark' : 'light');
            document.documentElement.setAttribute('data-bs-theme', theme);
            // Instant background color to prevent light flicker
            if (theme === 'dark') {
                document.documentElement.style.backgroundColor = '#020617';
            }
        })();
    </script>
    @yield('styles')
</head>
<body>
    @include('partials.navbar')

    <main>
        @if(session('success'))
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="container mt-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Global GSAP Animations -->
    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
            gsap.registerPlugin(ScrollTrigger);
            
            // Standard fade up for individual elements
            gsap.utils.toArray('.gsap-fade-up').forEach(elem => {
                gsap.to(elem, {
                    scrollTrigger: {
                        trigger: elem,
                        start: "top 85%",
                        toggleActions: "play none none reverse"
                    },
                    y: 0,
                    opacity: 1,
                    duration: 0.8,
                    ease: "power3.out"
                });
            });

            // Reveal from left
            gsap.utils.toArray('.gsap-reveal-left').forEach(elem => {
                gsap.to(elem, {
                    scrollTrigger: {
                        trigger: elem,
                        start: "top 85%",
                        toggleActions: "play none none reverse"
                    },
                    x: 0,
                    opacity: 1,
                    duration: 1,
                    ease: "power3.out"
                });
            });

            // Reveal from right
            gsap.utils.toArray('.gsap-reveal-right').forEach(elem => {
                gsap.to(elem, {
                    scrollTrigger: {
                        trigger: elem,
                        start: "top 85%",
                        toggleActions: "play none none reverse"
                    },
                    x: 0,
                    opacity: 1,
                    duration: 1,
                    ease: "power3.out"
                });
            });

            // Staggered lists (e.g., car grids, feature lists)
            gsap.utils.toArray('.gsap-stagger-container').forEach(container => {
                const items = container.querySelectorAll('.gsap-stagger-item');
                if (items.length > 0) {
                    // Set initial state for items inside container
                    gsap.set(items, { y: 30, opacity: 0 });
                    
                    gsap.to(items, {
                        scrollTrigger: {
                            trigger: container,
                            start: "top 80%",
                            toggleActions: "play none none reverse"
                        },
                        y: 0,
                        opacity: 1,
                        duration: 0.6,
                        stagger: 0.15,
                        ease: "power2.out"
                    });
                }
            });
        });
    </script>

    <!-- Theme Switcher Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const html = document.documentElement;
            const themeToggle = document.getElementById('themeToggle');
            if (!themeToggle) return;
            
            const themeIcon = themeToggle.querySelector('i');
            
            const updateIcon = (theme) => {
                if (theme === 'dark') {
                    themeIcon.classList.replace('bi-moon-stars', 'bi-sun');
                } else {
                    themeIcon.classList.replace('bi-sun', 'bi-moon-stars');
                }
            };

            // Sync icon on load
            updateIcon(html.getAttribute('data-bs-theme'));

            themeToggle.addEventListener('click', () => {
                const currentTheme = html.getAttribute('data-bs-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                html.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('admin-theme', newTheme);
                updateIcon(newTheme);
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>
