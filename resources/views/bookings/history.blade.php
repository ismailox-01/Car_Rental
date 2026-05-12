@extends('layouts.app')

@section('title', 'My Booking Journey')

@section('styles')
<style>
    .booking-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .glass-card {
        background: var(--card-bg);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        border-radius: 1.5rem;
        transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        overflow: hidden;
    }
    
    .glass-card:hover {
        transform: translateY(-8px) scale(1.01);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }

    .booking-number {
        font-family: 'Monaco', 'Consolas', monospace;
        letter-spacing: 1px;
        color: var(--accent-color);
        font-size: 0.85rem;
        background: rgba(212, 175, 55, 0.1);
        padding: 4px 12px;
        border-radius: 2rem;
    }

    .status-pill {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        padding: 6px 16px;
        border-radius: 2rem;
        display: inline-block;
    }

    .price-tag {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--brand-text-dark);
    }

    .car-thumb {
        width: 120px;
        height: 80px;
        object-fit: cover;
        border-radius: 1rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .timeline-node {
        position: relative;
        padding-left: 25px;
    }

    .timeline-node::before {
        content: '';
        position: absolute;
        left: 0;
        top: 8px;
        width: 10px;
        height: 10px;
        background: var(--accent-color);
        border-radius: 50%;
        box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.2);
    }

    .timeline-line {
        position: absolute;
        left: 4px;
        top: 18px;
        bottom: -15px;
        width: 2px;
        background: rgba(0,0,0,0.05);
    }

    [data-bs-theme="dark"] .timeline-line {
        background: rgba(255,255,255,0.05);
    }
</style>
@endsection

@section('content')
<div class="py-5 min-vh-100">
    <div class="container py-4">
        <header class="mb-5 gsap-fade-up d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
            <div>
                <h1 class="display-5 fw-bold mb-2 text-theme-dark">My Booking Journey</h1>
                <p class="text-muted lead mb-0">Track your adventures and manage your reservations.</p>
            </div>
            <a href="{{ route('profile.show') }}" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                <i class="bi bi-person-circle me-2"></i>Back to Profile Hub
            </a>
        </header>
        
        @if($bookings->isEmpty())
            <div class="glass-card p-5 text-center gsap-fade-up">
                <div class="display-1 text-muted opacity-25 mb-4"><i class="bi bi-compass"></i></div>
                <h3 class="fw-bold text-theme-dark">No journeys found yet</h3>
                <p class="text-muted mb-4">Your next great road trip is just a few clicks away.</p>
                <a href="{{ route('cars.index') }}" class="btn btn-primary rounded-pill px-5">Explore Fleet</a>
            </div>
        @else
            <div class="gsap-stagger-container">
                @foreach($bookings as $booking)
                    <div class="glass-card p-4 p-md-5 mb-4 gsap-stagger-item shadow-sm">
                        <div class="row align-items-center g-4">
                            <!-- Car Info -->
                            <div class="col-lg-4">
                                <div class="d-flex align-items-center mb-4">
                                    <img src="{{ $booking->car->primaryImage ? asset('storage/' . $booking->car->primaryImage->image_path) : 'https://images.unsplash.com/photo-1542281286-9e0a16bb7366?auto=format&fit=crop&q=80&w=800' }}" class="car-thumb me-4" alt="Vehicle">
                                    <div>
                                        <div class="booking-number mb-2">#{{ $booking->booking_number }}</div>
                                        <h4 class="fw-extrabold mb-1 text-theme-dark">{{ $booking->car->brand }} {{ $booking->car->model }}</h4>
                                        <div class="text-muted small fw-medium">{{ $booking->car->year }} • {{ ucfirst($booking->car->type) }} Class</div>
                                    </div>
                                </div>
                                <div class="price-tag">{{ number_format($booking->total_price) }} <span class="small text-muted fs-5 fw-normal">MAD</span></div>
                            </div>

                            <!-- Timeline -->
                            <div class="col-md-6 col-lg-5">
                                <div class="row g-0">
                                    <div class="col-6">
                                        <div class="timeline-node">
                                            <div class="timeline-line"></div>
                                            <div class="small fw-bold text-uppercase text-muted letter-spacing-1">Pickup</div>
                                            <div class="text-theme-dark fw-bold">{{ $booking->pickup_date->format('D, M d Y') }}</div>
                                            <div class="small text-muted">{{ $booking->pickupLocation->full_name }}</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="timeline-node">
                                            <div class="small fw-bold text-uppercase text-muted letter-spacing-1">Return</div>
                                            <div class="text-theme-dark fw-bold">{{ $booking->return_date->format('D, M d Y') }}</div>
                                            <div class="small text-muted">{{ $booking->dropoffLocation->full_name }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 p-2 bg-light rounded-pill d-inline-flex align-items-center px-4">
                                    <i class="bi bi-clock-history me-2 text-primary"></i>
                                    <span class="small fw-bold">{{ $booking->total_days }} days journey</span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="col-md-6 col-lg-3 text-lg-end">
                                <div class="mb-3">
                                    <span class="status-pill bg-{{ $booking->status_badge }} bg-opacity-10 text-{{ $booking->status_badge }}">
                                        {{ $booking->status }}
                                    </span>
                                </div>
                                <div class="d-flex flex-column gap-2">
                                    <a href="{{ route('bookings.confirmation', $booking) }}" class="btn btn-dark rounded-pill py-2">
                                        <i class="bi bi-info-circle me-2"></i>View Details
                                    </a>
                                    @if($booking->canBeCancelled())
                                        <form method="POST" action="{{ route('bookings.cancel', $booking) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger border-0 rounded-pill py-2 w-100" onclick="return confirm('Abort this journey?')">
                                                <i class="bi bi-x-circle me-2"></i>Cancel Booking
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center gsap-fade-up">
                {{ $bookings->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>

<style>
    .letter-spacing-1 { letter-spacing: 1px; }
    .fw-extrabold { font-weight: 800; }
</style>
@endsection
