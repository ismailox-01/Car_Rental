<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Authentication</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- GSAP -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

        <style>
            :root {
                --accent-color: #d4af37;
                --primary-dark: #020617;
                --glass-bg: rgba(20, 25, 35, 0.4); /* Deeper, richer glass */
                --glass-border: rgba(255, 255, 255, 0.08);
                --glass-highlight: rgba(255, 255, 255, 0.05);
            }

            body {
                font-family: 'Outfit', sans-serif;
                background-color: var(--primary-dark);
                color: #f8fafc;
                margin: 0;
                overflow: hidden;
            }

            /* Animated Mesh Gradient */
            .mesh-gradient {
                position: fixed;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                z-index: -2;
                background: radial-gradient(circle at 50% 50%, rgba(212, 175, 55, 0.08) 0%, transparent 40%),
                            radial-gradient(circle at 80% 20%, rgba(15, 23, 42, 0.9) 0%, transparent 50%),
                            radial-gradient(circle at 20% 80%, #020617 0%, #000 100%);
                animation: meshDrift 30s ease-in-out infinite alternate;
            }

            @keyframes meshDrift {
                0% { transform: translate(0, 0) scale(1); }
                100% { transform: translate(-5%, -5%) scale(1.05); }
            }

            /* Cinematic Overlay */
            .bg-image-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1;
                background-image: url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=1920');
                background-size: cover;
                background-position: center;
                opacity: 0.12;
                filter: grayscale(80%) contrast(1.2);
                mix-blend-mode: luminosity;
            }

            /* Premium Glassmorphism */
            .glass-card {
                background: var(--glass-bg);
                backdrop-filter: blur(25px);
                -webkit-backdrop-filter: blur(25px);
                border: 1px solid var(--glass-border);
                box-shadow: 
                    0 30px 60px -15px rgba(0, 0, 0, 0.7),
                    inset 0 1px 0 var(--glass-highlight); /* Top highlight for glass edge */
                position: relative;
            }

            /* Subtle glow behind the card */
            .glass-card::before {
                content: '';
                position: absolute;
                inset: -1px;
                border-radius: inherit;
                padding: 1px;
                background: linear-gradient(135deg, rgba(212,175,55,0.2) 0%, transparent 50%, rgba(255,255,255,0.05) 100%);
                -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
                -webkit-mask-composite: xor;
                mask-composite: exclude;
                pointer-events: none;
            }

            .text-gold { color: var(--accent-color); }
            .bg-gold { background-color: var(--accent-color); color: #000; }
            
            /* Inputs */
            .input-luxury {
                background: rgba(0, 0, 0, 0.2) !important;
                border: 1px solid rgba(255, 255, 255, 0.05) !important;
                color: #fff !important;
                box-shadow: inset 0 2px 4px rgba(0,0,0,0.3) !important;
                transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
            }
            .input-luxury::placeholder {
                color: rgba(255, 255, 255, 0.2);
            }
            .input-luxury:focus {
                border-color: var(--accent-color) !important;
                box-shadow: 
                    inset 0 2px 4px rgba(0,0,0,0.3),
                    0 0 15px rgba(212, 175, 55, 0.15) !important;
                background: rgba(0, 0, 0, 0.4) !important;
                transform: translateY(-1px);
            }

            /* Button with Shine Sweep */
            .btn-luxury {
                background: var(--accent-color);
                color: #000;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 1.5px;
                border: none;
                position: relative;
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
                box-shadow: 0 4px 15px rgba(212, 175, 55, 0.2);
            }
            
            .btn-luxury::after {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 50%;
                height: 100%;
                background: linear-gradient(to right, transparent, rgba(255,255,255,0.4), transparent);
                transform: skewX(-20deg);
                transition: all 0.6s ease;
            }

            .btn-luxury:hover {
                background: #f1c40f;
                transform: translateY(-3px);
                box-shadow: 0 10px 25px rgba(212, 175, 55, 0.4);
            }
            
            .btn-luxury:hover::after {
                left: 150%;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="mesh-gradient"></div>
        <div class="bg-image-overlay"></div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="w-full sm:max-w-md mt-6 px-10 py-14 overflow-hidden rounded-3xl gsap-card">
                {{ $slot }}
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
