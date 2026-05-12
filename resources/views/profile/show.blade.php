@extends('layouts.app')

@section('title', 'Profile Hub')

@section('styles')
<style>
    .profile-hero { margin-bottom: 3rem; }
    
    .glass-card {
        background: var(--card-bg);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(15px);
        border-radius: 2rem;
        transition: all 0.4s ease;
    }
    
    .avatar-wrapper {
        position: relative;
        padding: 5px;
        background: linear-gradient(45deg, var(--accent-color), transparent);
        border-radius: 50%;
        display: inline-block;
    }
    
    .avatar-img {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid var(--card-bg);
    }
    
    .stat-pill {
        background: rgba(212, 175, 55, 0.1);
        border: 1px solid rgba(212, 175, 55, 0.2);
        border-radius: 1.5rem;
        padding: 1rem;
        transition: all 0.3s ease;
    }
    
    .stat-pill:hover {
        background: rgba(212, 175, 55, 0.15);
        transform: translateY(-3px);
    }
    
    .doc-status {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    
    .active-booking-card {
        border-left: 4px solid var(--accent-color);
    }
    
    .hover-bg-light:hover {
        background: rgba(15, 23, 42, 0.05) !important;
        color: var(--primary-color) !important;
    }
    
    .transition-all {
        transition: all 0.3s ease;
    }
</style>
@endsection

@section('content')
<div class="py-5 min-vh-100">
    <div class="container py-4">
        <div class="row g-5">
            <!-- Left Column: Identity -->
            <div class="col-lg-4 gsap-reveal-left">
                <div class="glass-card p-4 text-center sticky-top shadow-sm border-0" style="top: 100px; z-index: 1000;">
                    <div class="profile-hero text-center mb-0">
                        <div class="avatar-wrapper mb-4">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" class="avatar-img shadow-lg" alt="{{ $user->name }}">
                            @else
                                <div class="avatar-img shadow-lg d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary font-monospace fs-1 fw-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr(strrchr($user->name, ' '), 1, 1)) ?: '' }}
                                </div>
                            @endif
                        </div>
                        <h3 class="fw-extrabold mb-1 text-theme-dark">{{ $user->name }}</h3>
                        <p class="text-muted small mb-3 opacity-75">{{ $user->email }}</p>
                        <div class="badge bg-primary bg-opacity-10 text-primary px-4 py-2 rounded-pill fw-bold mb-5">
                            <i class="bi bi-patch-check-fill me-2"></i>{{ strtoupper($user->role) }} MEMBER
                        </div>
                    </div>
                    
                    <div class="nav flex-column nav-pills gap-3 text-start mt-2">
                        <a href="{{ route('profile.show') }}" class="nav-link active rounded-pill px-4 py-3 border-0 d-flex align-items-center transition-all bg-primary text-white shadow-sm">
                            <i class="bi bi-grid-1x2-fill me-3 fs-5"></i>
                            <span class="fw-bold">Dashboard Overview</span>
                        </a>
                        <a href="{{ route('bookings.history') }}" class="nav-link rounded-pill px-4 py-3 border-0 text-muted d-flex align-items-center transition-all hover-bg-light">
                            <i class="bi bi-calendar-check me-3 fs-5"></i>
                            <span class="fw-bold">Booking History</span>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="nav-link rounded-pill px-4 py-3 border-0 text-muted d-flex align-items-center transition-all hover-bg-light">
                            <i class="bi bi-gear-fill me-3 fs-5"></i>
                            <span class="fw-bold">Account Settings</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Details & Stats -->
            <div class="col-lg-8">
                <div class="gsap-stagger-container">

                    <!-- Personal Intel -->
                    <div class="glass-card p-4 p-md-5 mb-4 shadow-sm gsap-stagger-item border-0">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div>
                                <h4 class="fw-bold mb-1 text-theme-dark">Identity Details</h4>
                                <p class="text-muted small mb-0">Your verified personal credentials</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary rounded-pill btn-sm px-4 py-2 fw-bold">Update Details</a>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="stat-pill h-100">
                                    <label class="small text-muted text-uppercase fw-bold d-block mb-2 opacity-50">Phone Connectivity</label>
                                    <div class="fw-bold text-theme-dark fs-5">{{ $user->phone ?: 'Not linked' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="stat-pill h-100">
                                    <label class="small text-muted text-uppercase fw-bold d-block mb-2 opacity-50">License Registry</label>
                                    <div class="fw-bold text-theme-dark fs-5">{{ $user->license_number ?: 'Unverified' }}</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="stat-pill border-0 bg-light">
                                    <label class="small text-muted text-uppercase fw-bold d-block mb-2 opacity-50">Primary Home Base</label>
                                    <div class="fw-bold text-theme-dark">{{ $user->address ?: 'Set your primary address in settings' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Document Verification -->
                    <div class="glass-card p-4 p-md-5 mb-4 shadow-sm gsap-stagger-item">
                        <h4 class="fw-bold mb-4 text-theme-dark">Trust & Compliance</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 border rounded-4 d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light p-2 rounded-3 me-3"><i class="bi bi-card-text fs-4 text-primary"></i></div>
                                        <div class="fw-bold small text-theme-dark">National Identity</div>
                                    </div>
                                    <span class="doc-status text-{{ $user->id_card_image ? 'success' : 'warning' }}">
                                        {!! $user->id_card_image ? '<i class="bi bi-patch-check-fill me-1"></i>VERIFIED' : '<i class="bi bi-hourglass-split me-1"></i>PENDING' !!}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 border rounded-4 d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light p-2 rounded-3 me-3"><i class="bi bi-file-earmark-person fs-4 text-primary"></i></div>
                                        <div class="fw-bold small text-theme-dark">Driving License</div>
                                    </div>
                                    <span class="doc-status text-{{ $user->driving_license_image ? 'success' : 'warning' }}">
                                        {!! $user->driving_license_image ? '<i class="bi bi-patch-check-fill me-1"></i>VERIFIED' : '<i class="bi bi-hourglass-split me-1"></i>PENDING' !!}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Active Pursuits -->
                    @if(!$activeBookings->isEmpty())
                        <div class="glass-card p-4 p-md-5 shadow-sm gsap-stagger-item">
                            <h4 class="fw-bold mb-4 text-theme-dark">Active Deployments</h4>
                            @foreach($activeBookings as $booking)
                                <div class="glass-card p-3 active-booking-card border shadow-none mb-3">
                                    <div class="row align-items-center g-3">
                                        <div class="col-auto">
                                            <img src="{{ $booking->car->primaryImage ? asset('storage/' . $booking->car->primaryImage->image_path) : 'https://images.unsplash.com/photo-1542281286-9e0a16bb7366?auto=format&fit=crop&q=80&w=800' }}" class="rounded-4" style="width: 120px; height: 80px; object-fit: cover;">
                                        </div>
                                        <div class="col">
                                            <h6 class="fw-extrabold mb-1 text-theme-dark">{{ $booking->car->brand }} {{ $booking->car->model }}</h6>
                                            <div class="small text-muted"><i class="bi bi-calendar-week me-2"></i>Until {{ $booking->return_date->format('M d, Y') }}</div>
                                        </div>
                                        <div class="col-auto text-end">
                                            <span class="badge bg-{{ $booking->status_badge }} rounded-pill mb-2 d-inline-block">{{ strtoupper($booking->status) }}</span>
                                            <a href="{{ route('bookings.confirmation', $booking) }}" class="btn btn-outline-dark btn-sm rounded-pill d-block">Manage</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-extrabold { font-weight: 800; }
</style>
@endsection
