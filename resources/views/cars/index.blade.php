@extends('layouts.app')

@section('title', 'Browse Premium Fleet')

@section('content')
<!-- Page Header -->
<div class="bg-dark text-white py-5 position-relative overflow-hidden mb-5">
    <div class="position-absolute w-100 h-100 top-0 start-0" style="background: url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&q=80&w=1920') center/cover; opacity: 0.2;"></div>
    <div class="container text-center position-relative z-index-1 gsap-fade-up">
        <h1 class="display-4 fw-bold mb-3" style="font-family: serif; font-style: italic;">Curated Collection</h1>
        <p class="lead mb-0 text-white-50">Discover the perfect vehicle for your Moroccan adventure.</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row g-4">
        <!-- Sidebar Filters -->
        <div class="col-lg-3">
            <div class="card p-4 rounded-4 shadow-sm border-0 sticky-top gsap-reveal-left" style="top: 100px; z-index: 10;">
                <h5 class="fw-bold mb-4 tracking-wider text-uppercase small text-primary">Refine Search</h5>
                <form action="{{ route('cars.index') }}" method="GET">
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Brand or Model</label>
                        <input type="text" name="brand" class="form-control bg-light border-0 py-2 shadow-none" placeholder="e.g. Mercedes..." value="{{ request('brand') }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Vehicle Class</label>
                        <select name="type" class="form-select bg-light border-0 py-2 shadow-none">
                            <option value="">All Classes</option>
                            @foreach(['sedan', 'suv', 'luxury', 'economy', 'van', 'sports'] as $type)
                                <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Transmission</label>
                        <div class="mt-2 text-muted fw-medium small">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="transmission" value="" id="transAll" {{ !request('transmission') ? 'checked' : '' }}>
                                <label class="form-check-label" for="transAll">Any</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="transmission" value="automatic" id="transAuto" {{ request('transmission') == 'automatic' ? 'checked' : '' }}>
                                <label class="form-check-label" for="transAuto">Automatic</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="transmission" value="manual" id="transManual" {{ request('transmission') == 'manual' ? 'checked' : '' }}>
                                <label class="form-check-label" for="transManual">Manual</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Fuel Type</label>
                        <select name="fuel_type" class="form-select bg-light border-0 py-2 shadow-none">
                            <option value="">Any Fuel</option>
                            @foreach(['petrol', 'diesel', 'electric', 'hybrid'] as $fuel)
                                <option value="{{ $fuel }}" {{ request('fuel_type') == $fuel ? 'selected' : '' }}>{{ ucfirst($fuel) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Sort By</label>
                        <select name="sort" class="form-select bg-light border-0 py-2 shadow-none">
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Additions</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                        </select>
                    </div>

                    <div class="d-grid gap-3 mt-5">
                        <button type="submit" class="btn btn-primary fw-bold py-2 rounded-pill shadow-sm">Apply Filters</button>
                        <a href="{{ route('cars.index') }}" class="btn btn-outline-dark fw-bold py-2 rounded-pill">Clear All</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Car Listing Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4 gsap-fade-up">
                <p class="mb-0 text-muted">Viewing <strong class="text-dark">{{ $cars->total() }}</strong> vehicles</p>
            </div>

            @if($cars->isEmpty())
                <div class="text-center py-5 gsap-fade-up">
                    <div class="fs-1 text-muted mb-3"><i class="bi bi-search"></i></div>
                    <h3 class="fw-bold" style="font-family: serif; font-style: italic;">No vehicles found</h3>
                    <p class="text-muted">We couldn't find any cars matching your criteria. Try adjusting your filters.</p>
                </div>
            @else
                <div class="row g-4 gsap-stagger-container perspective-wrapper">
                    @foreach($cars as $car)
                        <div class="col-md-6 col-xl-4 gsap-stagger-item">
                            <div class="card h-100 bg-white border-0 shadow-sm rounded-4 overflow-hidden group luxury-card-3d" style="transform-style: preserve-3d;">
                                <div class="position-relative overflow-hidden" style="transform: translateZ(30px);">
                                     <img src="{{ $car->primaryImage ? asset('storage/' . $car->primaryImage->image_path) : 'https://images.unsplash.com/photo-1542281286-9e0a16bb7366?auto=format&fit=crop&q=80&w=800' }}" 
                                         class="w-100 transition duration-500 group-hover-scale" style="height: 220px; object-fit: cover;" alt="{{ $car->brand }} {{ $car->model }}">
                                    <div class="position-absolute top-0 end-0 p-3" style="z-index: 5; transform: translateZ(40px);">
                                        <span class="badge bg-white text-dark rounded-pill px-3 shadow-sm py-2 fw-bold"><i class="bi bi-star-fill text-primary me-1"></i>{{ number_format($car->rating, 1) }}</span>
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
                                        <div class="col-6"><i class="bi bi-gear text-primary opacity-75 me-2"></i>{{ ucfirst($car->transmission) }}</div>
                                        <div class="col-6"><i class="bi bi-fuel-pump text-primary opacity-75 me-2"></i>{{ ucfirst($car->fuel_type) }}</div>
                                        <div class="col-6"><i class="bi bi-people text-primary opacity-75 me-2"></i>{{ $car->seats }} Seats</div>
                                        <div class="col-6"><i class="bi bi-briefcase text-primary opacity-75 me-2"></i>{{ $car->luggage }} Lugg.</div>
                                    </div>
                                    
                                    <div class="d-grid gap-2" style="transform: translateZ(30px);">
                                        <a href="{{ route('cars.show', $car) }}" class="btn btn-premium rounded-pill py-2 fw-bold interaction-btn">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-5 d-flex justify-content-center gsap-fade-up custom-pagination">
                    {{ $cars->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .tracking-wider { letter-spacing: 0.1em; }
    .transition { transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); }
    .duration-500 { transition-duration: 0.5s; }
    .z-index-1 { z-index: 1; }
    
    .group:hover .group-hover-scale { transform: scale(1.08); }
    
    .perspective-wrapper { perspective: 1000px; }
    
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
    
    /* Premium Pagination Styling */
    .custom-pagination .pagination {
        gap: 8px;
    }
    .custom-pagination .page-link {
        border-radius: 50% !important;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--secondary-color);
        border: 1px solid rgba(0,0,0,0.1);
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .custom-pagination .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    .custom-pagination .page-link:hover:not(.active) {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
        color: black;
        transform: translateY(-2px);
    }
    .custom-pagination .page-item.disabled .page-link {
        background-color: #f8fafc;
        color: #94a3b8;
        border-color: #e2e8f0;
        box-shadow: none;
    }
</style>

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", (event) => {
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
