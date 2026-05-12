@extends('layouts.app')

@section('title', 'Finalize Your Diamond Journey')

@section('styles')
<style>
    .booking-hero {
        background: var(--primary-color);
        padding: 6rem 0 3rem;
        position: relative;
        overflow: hidden;
    }
    
    .glass-card {
        background: var(--card-bg);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(15px);
        border-radius: 2rem;
        transition: all 0.4s ease;
    }
    
    [data-bs-theme="dark"] .glass-card {
        background: rgba(15, 23, 42, 0.6);
        border-color: rgba(255, 255, 255, 0.05);
    }
    
    .summary-card {
        position: sticky;
        top: 100px;
        z-index: 10;
        border: 1px solid var(--accent-color);
    }
    
    .form-control-glass {
        background: rgba(15, 23, 42, 0.03);
        border: 1px solid rgba(15, 23, 42, 0.08);
        border-radius: 1rem;
        padding: 0.75rem 1.25rem;
        transition: all 0.3s ease;
    }
    
    [data-bs-theme="dark"] .form-control-glass {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: white;
    }
    
    .form-control-glass:focus {
        background: transparent;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1);
    }
    
    .extra-item {
        border: 1px solid rgba(15, 23, 42, 0.05);
        border-radius: 1.25rem;
        padding: 1.25rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .extra-item:hover {
        border-color: var(--accent-color);
        background: rgba(212, 175, 55, 0.02);
    }
    
    .extra-item.active {
        border-color: var(--accent-color);
        background: rgba(212, 175, 55, 0.05);
    }
    
    .coupon-badge {
        font-size: 0.7rem;
        letter-spacing: 0.1em;
    }
</style>
@endsection

@section('content')
<div class="pb-5 min-vh-100">
    <div class="booking-hero mb-5">
        <div class="container py-4 text-center">
            <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold mb-3 small gsap-fade-up">RESERVATION PORTAL</div>
            <h1 class="display-4 fw-extrabold text-white mb-2 gsap-fade-up">Finalize Your Journey</h1>
            <p class="text-white-50 lead gsap-fade-up">Precision engineering meets personalized comfort.</p>
        </div>
    </div>

    <div class="container mt-n5">
        <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm">
            @csrf
            <input type="hidden" name="car_id" value="{{ $car->id }}">
            
            <div class="row g-5">
                <!-- Left: Details Form -->
                <div class="col-lg-8">
                    <!-- 1. Trip Intel -->
                    <div class="glass-card p-4 p-md-5 mb-4 shadow-sm gsap-fade-up border-0">
                        <div class="d-flex align-items-center mb-5">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;"><i class="bi bi-geo-alt-fill fs-5"></i></div>
                            <div>
                                <h4 class="fw-bold mb-1 text-theme-dark">Trip Coordinates</h4>
                                <p class="text-muted small mb-0">Select your departure and return logistics</p>
                            </div>
                        </div>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase tracking-wider">Pickup Location</label>
                                <select name="pickup_location_id" class="form-select form-control-glass py-2" required>
                                    @foreach($locations as $loc)
                                        <option value="{{ $loc->id }}" {{ request('pickup_location') == $loc->id ? 'selected' : '' }}>{{ $loc->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase tracking-wider">Drop-off Point</label>
                                <select name="dropoff_location_id" class="form-select form-control-glass py-2" required>
                                    @foreach($locations as $loc)
                                        <option value="{{ $loc->id }}" {{ (request('dropoff_location') == $loc->id || request('pickup_location') == $loc->id) ? 'selected' : '' }}>{{ $loc->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase tracking-wider">Deployment Date</label>
                                <input type="date" name="pickup_date" id="pickup_date" class="form-control form-control-glass py-2" required value="{{ request('pickup_date', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase tracking-wider">Return Date</label>
                                <input type="date" name="return_date" id="return_date" class="form-control form-control-glass py-2" required value="{{ request('return_date', date('Y-m-d', strtotime('+1 day'))) }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                            </div>
                        </div>
                    </div>

                    <!-- 2. Performance Extras -->
                    <div class="glass-card p-4 p-md-5 mb-4 shadow-sm gsap-fade-up border-0">
                        <div class="d-flex align-items-center mb-5">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;"><i class="bi bi-plus-circle-fill fs-5"></i></div>
                            <div>
                                <h4 class="fw-bold mb-1 text-theme-dark">Premium Enhancements</h4>
                                <p class="text-muted small mb-0">Optional upgrades for your experience</p>
                            </div>
                        </div>

                        <div class="row g-3">
                            @php
                                $extras = [
                                    ['id' => 'extraGPS', 'name' => 'GPS Navigation', 'price' => 10, 'icon' => 'bi-geo-alt', 'val' => 'gps', 'desc' => 'Precision tracking for every mile.'],
                                    ['id' => 'extraSeat', 'name' => 'Child Safety Seat', 'price' => 15, 'icon' => 'bi-emoji-smile', 'val' => 'child_seat', 'desc' => 'Premium protection for small travelers.'],
                                    ['id' => 'extraIns', 'name' => 'Full Coverage', 'price' => 25, 'icon' => 'bi-shield-check', 'val' => 'insurance', 'desc' => 'Total peace of mind, zero liability.'],
                                ];
                            @endphp

                            @foreach($extras as $extra)
                            <div class="col-md-12">
                                <label class="extra-item d-flex align-items-center justify-content-between w-100 mb-0 transition-all" for="{{ $extra['id'] }}">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light p-3 rounded-4 me-4"><i class="bi {{ $extra['icon'] }} fs-4 text-primary"></i></div>
                                        <div>
                                            <h6 class="fw-bold mb-1 text-theme-dark">{{ $extra['name'] }}</h6>
                                            <p class="small text-muted mb-0">{{ $extra['desc'] }}</p>
                                        </div>
                                    </div>
                                    <div class="text-end d-flex align-items-center gap-4">
                                        <span class="fw-extrabold text-theme-dark">{{ number_format($extra['price'], 2) }} MAD <small class="text-muted fw-normal">/ day</small></span>
                                        <div class="form-check">
                                            <input class="form-check-input extra-checkbox" type="checkbox" name="extras[]" value="{{ $extra['val'] }}" id="{{ $extra['id'] }}" data-price="{{ $extra['price'] }}">
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- 3. Promotion & Intel -->
                    <div class="row g-4 mb-4 gsap-fade-up">
                        <div class="col-md-6">
                            <div class="glass-card p-4 h-100 shadow-sm border-0">
                                <h5 class="fw-bold mb-3 text-theme-dark d-flex align-items-center"><i class="bi bi-tag-fill me-2 text-primary"></i> Exclusive Code</h5>
                                <div class="position-relative">
                                    <input type="text" name="coupon_code" id="coupon_input" class="form-control form-control-glass py-2 pe-5" placeholder="ELITE20">
                                    <div class="position-absolute top-50 end-0 translate-middle-y pe-3">
                                        <i class="bi bi-ticket-perforated fs-5 text-muted opacity-50"></i>
                                    </div>
                                </div>
                                <p class="x-small text-muted mt-2 mb-0">Applying a verified code will update your total immediately.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="glass-card p-4 h-100 shadow-sm border-0">
                                <h5 class="fw-bold mb-3 text-theme-dark d-flex align-items-center"><i class="bi bi-pencil-square me-2 text-primary"></i> Mission Notes</h5>
                                <textarea name="notes" class="form-control form-control-glass" rows="2" placeholder="Special requirements..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Summary Sidebar -->
                <div class="col-lg-4">
                    <div class="glass-card p-4 p-md-5 summary-card shadow-2xl bg-dark text-white border-primary border-opacity-25 gsap-fade-up">
                        <h4 class="fw-extrabold mb-5 d-flex align-items-center justify-content-between">
                            <span>Summary</span>
                            <span class="badge bg-primary rounded-pill small coupon-badge" style="display: none;" id="appliedCouponBadge">ELITE20 APPLIED</span>
                        </h4>

                        <div class="d-flex align-items-center mb-5 pb-5 border-bottom border-white border-opacity-10">
                            <img src="{{ $car->primaryImage ? asset('storage/' . $car->primaryImage->image_path) : 'https://images.unsplash.com/photo-1542281286-9e0a16bb7366?auto=format&fit=crop&q=80&w=800' }}" class="rounded-4 me-4 shadow-lg" style="width: 120px; height: 80px; object-fit: cover; border: 2px solid rgba(255,255,255,0.1);">
                            <div>
                                <h6 class="fw-extrabold mb-1">{{ $car->brand }} {{ $car->model }}</h6>
                                <div class="small opacity-50"><i class="bi bi-calendar3 me-2"></i> {{ number_format($car->price_per_day, 0) }} MAD / day</div>
                            </div>
                        </div>

                        <div class="space-y-4 mb-5">
                            <div class="d-flex justify-content-between mb-3 opacity-75">
                                <span class="small text-uppercase tracking-widest">Base Rate (<span id="summaryDays">1</span> days)</span>
                                <span class="fw-bold" id="summarySubtotal">0 MAD</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3 opacity-75" id="extrasRow" style="display: none !important;">
                                <span class="small text-uppercase tracking-widest">Enhancements</span>
                                <span class="fw-bold" id="summaryExtras">0 MAD</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3 text-primary" id="discountRow" style="display: none !important;">
                                <span class="small text-uppercase tracking-widest fw-bold">Discount Applied</span>
                                <span class="fw-extrabold" id="summaryDiscount">-0 MAD</span>
                            </div>
                        </div>

                        <div class="pt-5 border-top border-white border-opacity-10 mb-5">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0 fw-bold opacity-50 text-uppercase tracking-widest">Total cost</span>
                                <h2 class="fw-extrabold mb-0 text-white" id="summaryTotal">0 MAD</h2>
                            </div>
                        </div>

                        <div class="d-grid pt-2">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-extrabold py-3 shadow-lg hover-scale">
                                CONFIRM RESERVATION <i class="bi bi-chevron-right ms-2 fs-5"></i>
                            </button>
                            <p class="x-small text-center mt-4 opacity-50 fw-bold tracking-wider">
                                <i class="bi bi-shield-check me-2"></i> SECURE DEPLOYMENT PROTOCOL
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .fw-extrabold { font-weight: 800; }
    .tracking-widest { letter-spacing: 0.15em; }
    .tracking-wider { letter-spacing: 0.05em; }
    .hover-scale { transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
    .hover-scale:hover { transform: scale(1.02) translateY(-2px); box-shadow: 0 10px 20px rgba(212, 175, 55, 0.3) !important; }
    .mt-n5 { margin-top: -3rem; }
    .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
    [data-bs-theme="dark"] .bg-primary.bg-opacity-10 { background-color: rgba(212, 175, 55, 0.2) !important; }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pickupDateInput = document.getElementById('pickup_date');
        const returnDateInput = document.getElementById('return_date');
        const extraCheckboxes = document.querySelectorAll('.extra-checkbox');
        const couponInput = document.getElementById('coupon_input');
        
        const basePrice = {{ $car->price_per_day }};
        
        function updateSummary() {
            const start = new Date(pickupDateInput.value);
            const end = new Date(returnDateInput.value);
            
            let days = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
            if (isNaN(days) || days < 1) days = 1;
            
            document.getElementById('summaryDays').innerText = days;
            
            const subtotal = basePrice * days;
            document.getElementById('summarySubtotal').innerText = subtotal.toLocaleString() + ' MAD';
            
            let extrasTotal = 0;
            extraCheckboxes.forEach(cb => {
                const label = cb.closest('.extra-item');
                if (cb.checked) {
                    extrasTotal += parseFloat(cb.getAttribute('data-price')) * days;
                    label.classList.add('active');
                } else {
                    label.classList.remove('active');
                }
            });
            
            document.getElementById('summaryExtras').innerText = extrasTotal.toLocaleString() + ' MAD';
            document.getElementById('extrasRow').style.setProperty('display', extrasTotal > 0 ? 'flex' : 'none', 'important');
            
            let currentSubtotal = subtotal + extrasTotal;
            let discount = 0;
            
            // Simple mockup of coupon logic for "best" UX
            if (couponInput.value.toUpperCase() === 'ELITE20') {
                discount = currentSubtotal * 0.2;
                document.getElementById('appliedCouponBadge').style.display = 'inline-block';
                document.getElementById('discountRow').style.setProperty('display', 'flex', 'important');
                document.getElementById('summaryDiscount').innerText = '-' + discount.toLocaleString() + ' MAD';
            } else {
                document.getElementById('appliedCouponBadge').style.display = 'none';
                document.getElementById('discountRow').style.setProperty('display', 'none', 'important');
            }
            
            const total = currentSubtotal - discount;
            document.getElementById('summaryTotal').innerText = total.toLocaleString() + ' MAD';
        }
        
        pickupDateInput.addEventListener('change', updateSummary);
        returnDateInput.addEventListener('change', updateSummary);
        extraCheckboxes.forEach(cb => cb.addEventListener('change', updateSummary));
        couponInput.addEventListener('input', updateSummary);
        
        updateSummary();
    });
</script>
@endsection
