@extends('layouts.app')

@section('title', 'Morocco\'s Premium Car Rental')

@section('content')
<!-- Hero Section -->
<section class="hero-section position-relative overflow-hidden" style="height: 85vh; display: flex; align-items: center;">
    <!-- Parallax Background -->
    <div class="hero-bg position-absolute w-100 h-100" style="top: 0; left: 0; background: linear-gradient(rgba(15, 23, 42, 0.6), rgba(15, 23, 42, 0.8)), url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&q=80&w=1920') center/cover; z-index: 0; transform: scale(1.1);"></div>
    
    <div class="container position-relative z-index-2">
        <div class="row">
            <div class="col-lg-8 text-white">
                <div class="overflow-hidden mb-3">
                    <span class="badge bg-primary px-3 py-2 rounded-pill text-dark tracking-wider small hero-element" style="opacity: 0; transform: translateY(30px); display: inline-block;">MOROCCO'S #1 FLEET</span>
                </div>
                <div class="overflow-hidden mb-4">
                    <h1 class="display-3 fw-bold hero-element" style="line-height: 1.1; opacity: 0; transform: translateY(50px);">Experience Luxury <br><span class="text-primary" style="font-family: serif; font-style: italic;">Without Limits</span></h1>
                </div>
                <div class="overflow-hidden mb-5">
                    <p class="lead opacity-75 hero-element" style="max-width: 600px; opacity: 0; transform: translateY(30px);">Elevate your Moroccan journey with our curated selection of premium vehicles. Because how you travel matters as much as the destination.</p>
                </div>
                <div class="d-flex gap-3 hero-element" style="opacity: 0; transform: translateY(30px);">
                    <a href="{{ route('cars.index') }}" class="btn btn-primary d-inline-flex align-items-center rounded-pill">
                        Explore Fleet <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                    <a href="{{ route('about') }}" class="btn btn-outline-light rounded-pill px-4" style="text-transform: uppercase; font-weight: 500; letter-spacing: 1px;">
                        Our Legacy
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Decorative Shape -->
    <div class="position-absolute bottom-0 end-0 p-5 hero-shape d-none d-lg-block pointer-events-none" style="opacity: 0; transform: translateX(50px);">
        <svg width="300" height="300" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 0L200 100L100 200L0 100L100 0Z" fill="var(--accent-color)"/>
            <circle cx="100" cy="100" r="40" fill="white" fill-opacity="0.1"/>
        </svg>
    </div>
</section>

<!-- Search Form Overlay -->
<div class="container position-relative search-form-wrapper" style="margin-top: -80px; z-index: 10; opacity: 0; transform: translateY(40px) scale(0.95); filter: blur(10px);">
    <div class="card p-4 rounded-4 shadow-lg border-0 glass-panel bg-white">
        <form action="{{ route('search') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-lg-3 col-md-6">
                <label class="form-label text-muted small text-uppercase fw-bold tracking-wider">From Location</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 text-primary"><i class="bi bi-geo-alt-fill"></i></span>
                    <select name="pickup_location" class="form-select bg-light border-0 py-2 fw-medium shadow-none">
                        <option value="">Select City/Airport</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc->id }}">{{ $loc->full_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <label class="form-label text-muted small text-uppercase fw-bold tracking-wider">To Location</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 text-primary"><i class="bi bi-geo-fill"></i></span>
                    <select name="dropoff_location" class="form-select bg-light border-0 py-2 fw-medium shadow-none">
                        <option value="">Select City/Airport</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc->id }}">{{ $loc->full_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <label class="form-label text-muted small text-uppercase fw-bold tracking-wider">Pick-up</label>
                <input type="date" name="pickup_date" class="form-control bg-light border-0 py-2 fw-medium shadow-none">
            </div>
            <div class="col-lg-2 col-md-6">
                <label class="form-label text-muted small text-uppercase fw-bold tracking-wider">Drop-off</label>
                <input type="date" name="return_date" class="form-control bg-light border-0 py-2 fw-medium shadow-none">
            </div>
            <div class="col-lg-2 col-md-12">
                <button type="submit" class="btn btn-dark w-100 py-2 rounded-3 shadow">Discover <i class="bi bi-search ms-1"></i></button>
            </div>
        </form>
    </div>
</div>

<!-- Why Choose Us -->
<section class="py-5 bg-white mt-5">
    <div class="container py-4">
        <div class="row text-center mb-5 gsap-fade-up">
            <div class="col-md-8 mx-auto">
                <span class="text-primary fw-bold text-uppercase tracking-wider small">The CarRental Difference</span>
                <h2 class="fw-bold mt-2 display-6 text-dark" style="font-family: 'Outfit', sans-serif;">Why Choose Us?</h2>
            </div>
        </div>
        <div class="row g-4 gsap-stagger-container">
            <div class="col-md-3 col-6 gsap-stagger-item text-center group">
                <div class="p-4 rounded-4 bg-light h-100 border border-light transition hover-border-primary">
                    <div class="fs-1 text-primary mb-3 transition group-hover-translate-y"><i class="bi bi-gem"></i></div>
                    <h5 class="fw-bold">Premium Fleet</h5>
                    <p class="text-muted small mb-0">Immaculately maintained vehicles from world-class brands.</p>
                </div>
            </div>
            <div class="col-md-3 col-6 gsap-stagger-item text-center group">
                <div class="p-4 rounded-4 bg-light h-100 border border-light transition hover-border-primary">
                    <div class="fs-1 text-primary mb-3 transition group-hover-translate-y"><i class="bi bi-shield-check"></i></div>
                    <h5 class="fw-bold">Full Insurance</h5>
                    <p class="text-muted small mb-0">Comprehensive coverage for absolute peace of mind.</p>
                </div>
            </div>
            <div class="col-md-3 col-6 gsap-stagger-item text-center group">
                <div class="p-4 rounded-4 bg-light h-100 border border-light transition hover-border-primary">
                    <div class="fs-1 text-primary mb-3 transition group-hover-translate-y"><i class="bi bi-headset"></i></div>
                    <h5 class="fw-bold">24/7 Concierge</h5>
                    <p class="text-muted small mb-0">Dedicated support available around the clock, anywhere in Morocco.</p>
                </div>
            </div>
            <div class="col-md-3 col-6 gsap-stagger-item text-center group">
                <div class="p-4 rounded-4 bg-light h-100 border border-light transition hover-border-primary">
                    <div class="fs-1 text-primary mb-3 transition group-hover-translate-y"><i class="bi bi-geo-alt"></i></div>
                    <h5 class="fw-bold">Anywhere Drop-off</h5>
                    <p class="text-muted small mb-0">Pick up in Casablanca, drop off in Marrakech. We make it easy.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Cars -->
<section class="py-5 bg-light position-relative">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-end mb-5 gsap-fade-up">
            <div>
                <span class="text-primary fw-bold text-uppercase tracking-wider small">Curated Collection</span>
                <h2 class="fw-bold mt-2 display-6 text-dark mb-0">Featured Vehicles</h2>
            </div>
            <a href="{{ route('cars.index') }}" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-medium d-none d-md-inline-block">View Full Fleet</a>
        </div>
        
        <div class="row g-4 gsap-stagger-container perspective-wrapper">
            @forelse($featuredCars as $car)
                <div class="col-lg-4 col-md-6 gsap-stagger-item">
                    <div class="card h-100 bg-white border-0 shadow-sm rounded-4 overflow-hidden group luxury-card-3d" style="transform-style: preserve-3d;">
                        <div class="position-relative overflow-hidden" style="transform: translateZ(30px);">
                            <img src="{{ $car->primaryImage ? asset('storage/' . $car->primaryImage->image_path) : 'https://images.unsplash.com/photo-1542281286-9e0a16bb7366?auto=format&fit=crop&q=80&w=800' }}" 
                                 class="card-img-top w-100 transition duration-500 group-hover-scale" 
                                 style="height: 240px; object-fit: cover;"
                                 alt="{{ $car->brand }} {{ $car->model }}">
                            <div class="position-absolute top-0 end-0 p-3" style="transform: translateZ(40px);">
                                <span class="badge bg-white text-dark rounded-pill shadow-sm px-3 py-2 fw-bold"><i class="bi bi-star-fill text-primary me-1"></i>{{ number_format($car->rating, 1) }}</span>
                            </div>
                        </div>
                        <div class="card-body p-4" style="transform: translateZ(20px);">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h5 class="fw-bold mb-0 text-dark">{{ $car->brand }} {{ $car->model }}</h5>
                                    <span class="text-uppercase small text-muted tracking-wider fw-bold">{{ $car->type }}</span>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold fs-5 text-primary">{{ number_format($car->price_per_day) }}<span class="small text-muted fs-6 fw-normal ms-1">MAD</span></div>
                                    <div class="small text-muted" style="margin-top: -5px;">/ day</div>
                                </div>
                            </div>
                            
                            <hr class="text-muted opacity-10 my-3">
                            
                            <div class="row g-2 text-muted small mb-4 fw-medium">
                                <div class="col-6"><i class="bi bi-people text-primary opacity-75 me-2"></i>{{ $car->seats }} Seats</div>
                                <div class="col-6"><i class="bi bi-gear text-primary opacity-75 me-2"></i>{{ ucfirst($car->transmission) }}</div>
                                <div class="col-6"><i class="bi bi-fuel-pump text-primary opacity-75 me-2"></i>{{ ucfirst($car->fuel_type) }}</div>
                                <div class="col-6"><i class="bi bi-snow text-primary opacity-75 me-2"></i>{{ $car->air_conditioning ? 'A/C' : 'No A/C' }}</div>
                            </div>
                            
                            <div class="d-grid gap-2" style="transform: translateZ(30px);">
                                <a href="{{ route('cars.show', $car) }}" class="btn btn-premium rounded-pill py-2 fw-bold interaction-btn">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">No featured cars available at the moment.</p>
                </div>
            @endforelse
        </div>
        
        <div class="text-center mt-5 d-md-none gsap-fade-up">
            <a href="{{ route('cars.index') }}" class="btn btn-dark rounded-pill px-4 py-2">View Full Fleet</a>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-dark text-white text-center position-relative overflow-hidden">
    <!-- Abstract background -->
    <div class="position-absolute top-50 start-50 translate-middle w-100 h-100" style="background: radial-gradient(circle, rgba(212,175,55,0.1) 0%, rgba(15,23,42,1) 70%); z-index: 0;"></div>
    
    <div class="container py-5 position-relative z-index-1 gsap-fade-up">
        <h2 class="display-5 fw-bold mb-4" style="font-family: serif; font-style: italic;">Ready to Start Your Journey?</h2>
        <p class="lead mb-5 col-md-8 mx-auto opacity-75 text-light fw-light">Join thousands of discerning travelers who trust us for their Moroccan adventures. Book your luxury vehicle today.</p>
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 rounded-pill shadow-lg">Become a Member</a>
    </div>
</section>

<style>
    /* Specific Home Page Utilities */
    .tracking-wider { letter-spacing: 0.1em; }
    .transition { transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); }
    .duration-500 { transition-duration: 0.5s; }
    
    .z-index-1 { z-index: 1; }
    .z-index-2 { z-index: 2; }
    
    .group:hover .group-hover-scale { transform: scale(1.08); }
    .group:hover .group-hover-translate-y { transform: translateY(-5px); color: var(--accent-color) !important; }
    
    .hover-border-primary:hover { border-color: rgba(212, 175, 55, 0.3) !important; }
    
    .btn-premium {
        background-color: #d4af37 !important;
        color: #000 !important;
        border: none !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
    }
    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    }
    .interaction-btn {
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    .interaction-btn::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 0%;
        background-color: #1a1a1a;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        z-index: -1;
    }
    .interaction-btn:hover {
        color: #d4af37 !important;
    }
    .interaction-btn:hover::before {
        height: 100%;
    }
    
    /* New Floating Animation */
    @keyframes float {
        0% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(2deg); }
        100% { transform: translateY(0px) rotate(0deg); }
    }
    .floating-element {
        animation: float 6s ease-in-out infinite;
    }
    
    .perspective-wrapper { perspective: 1000px; }
</style>

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        // Master Homepage Timeline - The "Wow" Factor
        const tl = gsap.timeline({ defaults: { ease: "power4.out" } });

        // 1. Subtle zoom down of the background image for a cinematic reveal
        tl.to(".hero-bg", {
            scale: 1,
            duration: 3,
            ease: "power2.out"
        }, 0)
        
        // 2. Staggered, fluid entrance of hero text elements with a larger slide-up
        .to(".hero-element", {
            y: 0,
            opacity: 1,
            duration: 1.5,
            stagger: 0.2,
            ease: "back.out(1.5)" 
        }, 0.5)
        
        // 3. Bring in the decorative shape and make it float
        .to(".hero-shape", {
            x: 0,
            opacity: 0.3,
            duration: 2,
            ease: "power3.out",
            onComplete: () => {
                document.querySelector('.hero-shape').classList.add('floating-element');
            }
        }, 1)
        
        // 4. Search form dramatic unblur and scale up into place
        .to(".search-form-wrapper", {
            y: 0,
            opacity: 1,
            scale: 1,
            filter: "blur(0px)",
            duration: 1.5,
            ease: "power4.out"
        }, 1.2);

        // ScrollTrigger Parallax Effect for Hero Background
        gsap.to(".hero-bg", {
            yPercent: 40, // Increased parallax intensity
            ease: "none",
            scrollTrigger: {
                trigger: ".hero-section",
                start: "top top",
                end: "bottom top",
                scrub: 1.5 // Added smoothing to the scrub
            }
        });
        
        // Enhanced Staggered Reveals for Sections
        gsap.utils.toArray('.gsap-stagger-container').forEach(container => {
            const items = container.querySelectorAll('.gsap-stagger-item');
            if (items.length > 0) {
                gsap.set(items, { y: 50, opacity: 0, scale: 0.95 }); // Initial hidden state
                
                gsap.to(items, {
                    scrollTrigger: {
                        trigger: container,
                        start: "top 75%",
                        toggleActions: "play none none reverse"
                    },
                    y: 0,
                    opacity: 1,
                    scale: 1,
                    duration: 0.8,
                    stagger: 0.2,
                    ease: "back.out(1.2)"
                });
            }
        });

        // Enhanced Fade Ups for Section Headers
        gsap.utils.toArray('.gsap-fade-up').forEach(elem => {
            gsap.set(elem, { y: 30, opacity: 0 });
            gsap.to(elem, {
                scrollTrigger: {
                    trigger: elem,
                    start: "top 80%",
                    toggleActions: "play none none reverse"
                },
                y: 0,
                opacity: 1,
                duration: 1,
                ease: "power3.out"
            });
        });
        
        // Interactive Mousemove Parallax for the Decorative Shape (if it exists)
        const heroSection = document.querySelector('.hero-section');
        const shape = document.querySelector('.hero-shape');
        
        if (heroSection && shape) {
            heroSection.addEventListener('mousemove', (e) => {
                const xPos = (e.clientX / window.innerWidth - 0.5) * 60; // Increased movement range
                const yPos = (e.clientY / window.innerHeight - 0.5) * 60;
                
                gsap.to(shape, {
                    x: xPos,
                    y: yPos,
                    duration: 1.5,
                    ease: "power2.out"
                });
            });
            
            heroSection.addEventListener('mouseleave', () => {
                gsap.to(shape, { x: 0, y: 0, duration: 1.5, ease: "power2.out" });
            });
        }
        
        // 3D Luxury Tilt Effect for Cards
        const luxuryCards = document.querySelectorAll('.luxury-card-3d');
        luxuryCards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const xPos = e.clientX - rect.left; // x position within the element
                const yPos = e.clientY - rect.top;  // y position within the element
                
                // Calculate rotation based on cursor position (-10deg to 10deg)
                const xFilter = gsap.utils.mapRange(0, rect.width, -10, 10, xPos);
                const yFilter = gsap.utils.mapRange(0, rect.height, 10, -10, yPos);
                
                gsap.to(card, {
                    rotationY: xFilter,
                    rotationX: yFilter,
                    transformPerspective: 1000,
                    ease: "power1.out",
                    duration: 0.4,
                    overwrite: "auto"
                });
            });
            
            card.addEventListener('mouseleave', () => {
                gsap.to(card, {
                    rotationY: 0,
                    rotationX: 0,
                    ease: "power3.out",
                    duration: 1,
                    overwrite: "auto"
                });
            });
        });
    });
</script>
@endsection
@endsection
