@extends('layouts.app')

@section('title', 'Our Legacy | Premium Car Rental')

@section('content')
<!-- 3D Parallax Hero Section -->
<section class="position-relative overflow-hidden hero-section-about" style="height: 70vh; display: flex; align-items: center; perspective: 1000px;">
    <!-- Deep Parallax Background -->
    <div class="hero-bg-about position-absolute w-100 h-100" style="top: 0; left: 0; background: linear-gradient(rgba(15, 23, 42, 0.6), rgba(15, 23, 42, 0.9)), url('https://images.unsplash.com/photo-1502877338535-766e1452684a?auto=format&fit=crop&q=80&w=1920') center/cover; z-index: 0; transform: scale(1.1) translateZ(-100px);"></div>

    <div class="container position-relative z-index-2">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8 text-white mt-5 pt-4">
                <div class="overflow-hidden mb-3">
                    <span class="badge bg-primary px-3 py-2 rounded-pill text-dark tracking-wider small fw-bold hero-text-about d-inline-block" style="opacity: 0; transform: translateY(30px);">EST. 2018</span>
                </div>
                <div class="overflow-hidden mb-4">
                    <h1 class="display-2 fw-bold hero-text-about" style="font-family: serif; font-style: italic; opacity: 0; transform: translateY(50px);">The Moroccan<br><span class="text-primary">Standard</span></h1>
                </div>
                <div class="overflow-hidden">
                    <p class="lead opacity-75 hero-text-about" style="opacity: 0; transform: translateY(30px);">Redefining the road trip experience with uncompromising luxury, delivering vehicles that command respect and admiration.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Floating Stats Section (3D) -->
<div class="container position-relative gsap-fade-up perspective-wrapper" style="margin-top: -80px; z-index: 10;">
    <div class="card p-0 rounded-4 shadow-lg border-0 bg-white overflow-hidden luxury-card-3d" style="transform-style: preserve-3d;">
        <div class="row g-0 text-center" style="transform: translateZ(20px);">
            <div class="col-md-3 border-end border-bottom-md-0 border-bottom">
                <div class="p-4 py-5 hover-bg-light transition">
                    <div class="display-5 fw-bold text-primary mb-2">20+</div>
                    <div class="text-muted fw-bold text-uppercase small tracking-wider">Premium Vehicles</div>
                </div>
            </div>
            <div class="col-md-3 border-end border-bottom-md-0 border-bottom">
                <div class="p-4 py-5 hover-bg-light transition">
                    <div class="display-5 fw-bold text-primary mb-2">1k</div>
                    <div class="text-muted fw-bold text-uppercase small tracking-wider">Happy Clients</div>
                </div>
            </div>
            <div class="col-md-3 border-end border-bottom-md-0 border-bottom">
                <div class="p-4 py-5 hover-bg-light transition">
                    <div class="display-5 fw-bold text-primary mb-2">12</div>
                    <div class="text-muted fw-bold text-uppercase small tracking-wider">Global Cities</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 py-5 hover-bg-light transition">
                    <div class="display-5 fw-bold text-primary mb-2">4.9</div>
                    <div class="text-muted fw-bold text-uppercase small tracking-wider">Average Rating</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mission Section -->
<section class="py-5 my-5 bg-white overflow-hidden">
    <div class="container py-4">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 gsap-reveal-left">
                <span class="text-primary fw-bold text-uppercase tracking-wider small">Our Philosophy</span>
                <h2 class="display-5 fw-bold mb-4 text-dark mt-2" style="font-family: 'Outfit', sans-serif;">Where Quality Meets the Open Road</h2>
                <p class="text-muted fs-5 mb-5 leading-relaxed">At CarRental, our mission is to eliminate the friction from vehicle hire. We've optimized every touchpoint—from digital booking to curbside pickup—to ensure you spend less time at the counter and more time experiencing Morocco's breathtaking landscapes.</p>

                <div class="d-flex align-items-start mb-4 group">
                    <div class="bg-light p-3 rounded-circle me-4 transition group-hover-bg-primary">
                        <i class="bi bi-shield-check fs-3 text-dark transition group-hover-text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark">Safety Without Compromise</h5>
                        <p class="text-muted mb-0">Every vehicle in our fleet undergoes a rigorous multi-point inspection before every single rental.</p>
                    </div>
                </div>

                <div class="d-flex align-items-start group">
                    <div class="bg-light p-3 rounded-circle me-4 transition group-hover-bg-primary">
                        <i class="bi bi-lightning-charge fs-3 text-dark transition group-hover-text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark">Instant Mobility</h5>
                        <p class="text-muted mb-0">With our digital check-in process, go from the airport terminal to the driver's seat seamlessly.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 perspective-wrapper text-center">
                <!-- 3D Image Card -->
                <div class="d-inline-block position-relative group rounded-5 shadow-lg overflow-hidden luxury-card-3d" style="transform-style: preserve-3d; max-width: 100%;">
                    <div style="transform: translateZ(30px);">
                        <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?auto=format&fit=crop&q=80&w=1200" class="img-fluid w-100 transition duration-700 group-hover-scale about-parallax-img" alt="Our Fleet" style="min-height: 500px; object-fit: cover; transform: scale(1.1);">
                    </div>
                    <div class="position-absolute bottom-0 start-0 m-4" style="transform: translateZ(60px);">
                        <div class="bg-white p-4 rounded-4 shadow-lg border-start border-primary border-4" style="max-width: 280px; backdrop-filter: blur(10px); background: rgba(255,255,255,0.95);">
                            <h3 class="fw-bold mb-1 text-dark">100%</h3>
                            <p class="small mb-0 text-muted fw-medium">Customer satisfaction guarantee on every premium booking.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Timeline Journey (3D Interactive) -->
<section class="py-5 bg-light position-relative">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5 gsap-fade-up">
            <div class="col-lg-8">
                <span class="text-primary fw-bold text-uppercase tracking-wider small">The Road So Far</span>
                <h2 class="display-4 fw-bold mt-2 text-dark" style="font-family: serif; font-style: italic;">A Legacy of Excellence</h2>
            </div>
        </div>

        <div class="row justify-content-center mt-4 perspective-wrapper">
            <div class="col-lg-10 gsap-stagger-container">
                <!-- 3D Timeline Grid instead of a vertical line to look more premium -->
                <div class="row g-4 justify-content-center">

                    <div class="col-md-6 col-lg-5 gsap-stagger-item">
                        <div class="card bg-white border-0 shadow-sm p-5 rounded-4 h-100 luxury-card-3d group" style="transform-style: preserve-3d;">
                            <div style="transform: translateZ(30px);">
                                <div class="d-flex align-items-center mb-4">
                                    <h2 class="display-6 fw-bold text-dark mb-0 me-3">2018</h2>
                                    <span class="badge bg-primary px-3 py-2 rounded-pill text-dark fw-bold">THE GENESIS</span>
                                </div>
                                <p class="text-muted leading-relaxed mb-0">Started with just 5 luxury cars in a small garage. Our vision was simple: to redefine car rentals for discerning locals and tourists alike.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 gsap-stagger-item mt-md-5">
                        <div class="card bg-white border-0 shadow-sm p-5 rounded-4 h-100 luxury-card-3d group" style="transform-style: preserve-3d;">
                            <div style="transform: translateZ(30px);">
                                <div class="d-flex align-items-center mb-4">
                                    <h2 class="display-6 fw-bold text-dark mb-0 me-3">2020</h2>
                                    <span class="badge bg-primary px-3 py-2 rounded-pill text-dark fw-bold">DIGITAL AGE</span>
                                </div>
                                <p class="text-muted leading-relaxed mb-0">Launched our bespoke booking platform, ensuring seamless concierge-level service across all major Moroccan airports.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 gsap-stagger-item">
                        <div class="card bg-white border-0 shadow-sm p-5 rounded-4 h-100 luxury-card-3d group" style="transform-style: preserve-3d;">
                            <div style="transform: translateZ(30px);">
                                <div class="d-flex align-items-center mb-4">
                                    <h2 class="display-6 fw-bold text-dark mb-0 me-3">2022</h2>
                                    <span class="badge bg-primary px-3 py-2 rounded-pill text-dark fw-bold">EXPANSION</span>
                                </div>
                                <p class="text-muted leading-relaxed mb-0">Expanded our fleet presence to Marrakech, Tangier, and Agadir, permanently securing our place as a leading luxury provider.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 gsap-stagger-item mt-md-5">
                        <div class="card bg-dark border-0 shadow-lg p-5 rounded-4 h-100 luxury-card-3d group position-relative overflow-hidden" style="transform-style: preserve-3d;">
                            <div class="position-absolute w-100 h-100 top-0 start-0" style="background: radial-gradient(circle at top right, rgba(212,175,55,0.2), transparent 60%);"></div>
                            <div style="transform: translateZ(40px);" class="position-relative z-index-1">
                                <div class="d-flex align-items-center mb-4">
                                    <h2 class="display-6 fw-bold text-white mb-0 me-3">2024</h2>
                                    <span class="badge bg-white px-3 py-2 rounded-pill text-dark fw-bold">#1 CHOICE</span>
                                </div>
                                <p class="text-white-50 leading-relaxed mb-0">Recognized officially as the #1 Premium Car Rental Platform in Morocco for uncompromising quality and reliability.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-dark text-center position-relative overflow-hidden mb-5">
    <div class="position-absolute top-50 start-50 translate-middle w-100 h-100 opacity-25" style="background: radial-gradient(circle, rgba(212,175,55,0.4) 0%, rgba(15,23,42,0) 70%); z-index: 0;"></div>

    <div class="container py-5 my-md-4 position-relative z-index-1 gsap-fade-up">
        <h2 class="display-4 fw-bold mb-4 text-white" style="font-family: serif; font-style: italic;">Ready to Drive Your Dream?</h2>
        <p class="lead col-lg-8 mx-auto mb-5 text-white-50 fw-light">Join over 25,000 satisfied travelers who choose CarRental for every journey. Discover the true difference of premium service.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('cars.index') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow interaction-btn text-dark fw-bold">VIEW THE FLEET</a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg rounded-pill px-5 fw-bold">CONTACT US</a>
        </div>
    </div>
</section>

<style>
    .tracking-wider { letter-spacing: 0.1em; }
    .leading-relaxed { line-height: 1.7; }
    .transition { transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); }
    .duration-700 { transition-duration: 0.7s; }
    .z-index-1 { z-index: 1; }
    .z-index-2 { z-index: 2; }

    .hover-bg-light:hover { background-color: #f8fafc; }

    .group:hover .group-hover-scale { transform: scale(1.05); }
    .group:hover .group-hover-bg-primary { background-color: var(--primary-color) !important; border-color: var(--primary-color) !important; }
    .group:hover .group-hover-text-white { color: white !important; }

    .perspective-wrapper { perspective: 1200px; }

    .interaction-btn {
        position: relative;
        overflow: hidden;
        z-index: 1;
        border: none;
    }
    .interaction-btn::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 0%;
        background-color: white;
        transition: all 0.3s ease;
        z-index: -1;
    }
    .interaction-btn:hover {
        color: var(--primary-color) !important;
    }
    .interaction-btn:hover::before {
        height: 100%;
    }
</style>

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        // Hero Timeline
        const tl = gsap.timeline({ defaults: { ease: "power4.out" } });

        tl.to(".hero-bg-about", {
            scale: 1,
            duration: 3,
            ease: "power2.out"
        }, 0)
        .to(".hero-text-about", {
            y: 0,
            opacity: 1,
            duration: 1.5,
            stagger: 0.2,
            ease: "back.out(1.5)"
        }, 0.5);

        // Hero Parallax on Scroll
        gsap.to(".hero-bg-about", {
            yPercent: 30,
            ease: "none",
            scrollTrigger: {
                trigger: ".hero-section-about",
                start: "top top",
                end: "bottom top",
                scrub: 1.2
            }
        });

        // Image Parallax Effect
        gsap.to(".about-parallax-img", {
            yPercent: 15,
            ease: "none",
            scrollTrigger: {
                trigger: ".about-parallax-img",
                start: "top bottom",
                end: "bottom top",
                scrub: 1.5
            }
        });

        // 3D Luxury Tilt Effect for all cards on About page
        const luxuryCards = document.querySelectorAll('.luxury-card-3d');
        luxuryCards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const xPos = e.clientX - rect.left;
                const yPos = e.clientY - rect.top;

                // Reduced degrees for a subtler, heavier feel
                const xFilter = gsap.utils.mapRange(0, rect.width, -8, 8, xPos);
                const yFilter = gsap.utils.mapRange(0, rect.height, 8, -8, yPos);

                gsap.to(card, {
                    rotationY: xFilter,
                    rotationX: yFilter,
                    transformPerspective: 1200,
                    ease: "power2.out", // Smoother ease
                    duration: 0.6,
                    overwrite: "auto"
                });
            });

            card.addEventListener('mouseleave', () => {
                gsap.to(card, {
                    rotationY: 0,
                    rotationX: 0,
                    ease: "bounce.out", // Premium snap-back
                    duration: 1.5,
                    overwrite: "auto"
                });
            });
        });

        // Enhanced Reveal Left/Right
        gsap.utils.toArray('.gsap-reveal-left').forEach(elem => {
            gsap.set(elem, { x: -60, opacity: 0 });
            gsap.to(elem, {
                scrollTrigger: {
                    trigger: elem,
                    start: "top 85%",
                    toggleActions: "play none none reverse"
                },
                x: 0,
                opacity: 1,
                duration: 1.2,
                ease: "power4.out"
            });
        });

        gsap.utils.toArray('.gsap-reveal-right').forEach(elem => {
            gsap.set(elem, { x: 60, opacity: 0 });
            gsap.to(elem, {
                scrollTrigger: {
                    trigger: elem,
                    start: "top 85%",
                    toggleActions: "play none none reverse"
                },
                x: 0,
                opacity: 1,
                duration: 1.2,
                ease: "power4.out"
            });
        });
    });
</script>
@endsection
@endsection
