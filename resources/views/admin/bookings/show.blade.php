@extends('layouts.admin')

@section('page_title', 'Booking Details: ' . $booking->booking_number)

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h5 class="fw-bold mb-0">Trip Information</h5>
                <span class="badge bg-{{ $booking->status_badge }} rounded-pill px-4 py-2">{{ strtoupper($booking->status) }}</span>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-4">
                        <label class="small text-muted text-uppercase fw-bold d-block mb-2">Pickup</label>
                        <div class="fw-bold fs-5 mb-1"><i class="bi bi-calendar-event me-2 text-primary"></i>{{ $booking->pickup_date->format('l, M d, Y') }}</div>
                        <div class="text-dark"><i class="bi bi-geo-alt me-2 text-primary"></i>{{ $booking->pickupLocation->full_name }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-4">
                        <label class="small text-muted text-uppercase fw-bold d-block mb-2">Return</label>
                        <div class="fw-bold fs-5 mb-1"><i class="bi bi-calendar-check me-2 text-primary"></i>{{ $booking->return_date->format('l, M d, Y') }}</div>
                        <div class="text-dark"><i class="bi bi-geo-alt me-2 text-primary"></i>{{ $booking->dropoffLocation->full_name }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h5 class="fw-bold mb-4">Vehicle Reserved</h5>
            <div class="d-flex align-items-center">
                <img src="{{ $booking->car->primaryImage ? asset('storage/' . $booking->car->primaryImage->image_path) : 'https://images.unsplash.com/photo-1542281286-9e0a16bb7366?auto=format&fit=crop&q=80&w=800' }}" class="rounded-4 me-4 shadow-sm" width="200" style="object-fit: cover;">
                <div>
                    <h4 class="fw-bold mb-1">{{ $booking->car->brand }} {{ $booking->car->model }}</h4>
                    <p class="text-muted mb-3">{{ $booking->car->year }} • {{ ucfirst($booking->car->transmission) }} • {{ ucfirst($booking->car->fuel_type) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <h5 class="fw-bold mb-4">Billing Summary</h5>
            <div class="d-flex justify-content-between mb-3">
                <span class="text-muted">Daily Rate</span>
                <span class="fw-bold">{{ number_format($booking->car->price_per_day, 2) }} MAD</span>
            </div>
            <div class="d-flex justify-content-between mb-3 border-bottom pb-3">
                <span class="text-muted">Total Days</span>
                <span class="fw-bold">x {{ $booking->total_days }}</span>
            </div>
            
            {{-- الآن نتعامل مع $booking->extras كمصفوفة مباشرة لأننا استخدمنا الـ casts في الـ Model --}}
            @if(is_array($booking->extras) && count($booking->extras) > 0)
                <div class="mb-3 border-bottom pb-3">
                    <span class="text-muted small text-uppercase fw-bold d-block mb-2">Extras Included</span>
                    @foreach($booking->extras as $extra)
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted">{{ ucfirst(str_replace('_', ' ', $extra)) }}</span>
                            <span class="fw-bold">--</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mt-3">
                <h5 class="fw-bold mb-0">Grand Total</h5>
                <h4 class="fw-bold text-primary mb-0">{{ number_format($booking->total_price, 2) }} MAD</h4>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4 bg-dark text-white">
            <h5 class="fw-bold mb-4">Actions</h5>
            <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST">
                @csrf
                @method('PATCH')
                <select name="status" class="form-select bg-white bg-opacity-10 text-white border-0 py-2 mb-3">
                    @foreach(['pending', 'confirmed', 'completed', 'cancelled'] as $st)
                        <option value="{{ $st }}" {{ $booking->status == $st ? 'selected' : '' }} class="bg-dark">{{ ucfirst($st) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold">UPDATE STATUS</button>
            </form>
        </div>
    </div>
</div>
@endsection