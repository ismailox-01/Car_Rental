@extends('layouts.app')

@section('title', $car->brand . ' ' . $car->model)

@section('content')
<div class="bg-light py-5">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cars.index') }}">Browse Cars</a></li>
                <li class="breadcrumb-item active">{{ $car->brand }} {{ $car->model }}</li>
            </ol>
        </nav>

        <div class="row g-5">
            <!-- Left: Gallery and Specs -->
            <div class="col-lg-8">
                <!-- Gallery -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
                    <div id="carGallery" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @if($car->images->count() > 0)
                                @foreach($car->images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="{{ $car->brand }} {{ $car->model }}">
                                    </div>
                                @endforeach
                            @else
                                <div class="carousel-item active">
                                    <img src="https://images.unsplash.com/photo-1542362567-b055002b91f4?auto=format&fit=crop&q=80&w=1200" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Fallback car image">
                                </div>
                            @endif
                        </div>
                        @if($car->images->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#carGallery" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon p-3 bg-dark rounded-circle bg-opacity-50"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carGallery" data-bs-slide="next">
                                <span class="carousel-control-next-icon p-3 bg-dark rounded-circle bg-opacity-50"></span>
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Specs -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-5">
                    <h4 class="fw-bold mb-4">Specifications</h4>
                    <div class="row g-4">
                        <div class="col-md-4 col-6 text-center">
                            <div class="bg-light p-3 rounded-4">
                                <i class="bi bi-calendar-event fs-2 text-primary mb-2"></i>
                                <div class="small text-muted text-uppercase fw-bold">Year</div>
                                <div class="fw-bold">{{ $car->year }}</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6 text-center">
                            <div class="bg-light p-3 rounded-4">
                                <i class="bi bi-gear fs-2 text-primary mb-2"></i>
                                <div class="small text-muted text-uppercase fw-bold">Transmission</div>
                                <div class="fw-bold">{{ ucfirst($car->transmission) }}</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6 text-center">
                            <div class="bg-light p-3 rounded-4">
                                <i class="bi bi-fuel-pump fs-2 text-primary mb-2"></i>
                                <div class="small text-muted text-uppercase fw-bold">Fuel Type</div>
                                <div class="fw-bold">{{ ucfirst($car->fuel_type) }}</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6 text-center">
                            <div class="bg-light p-3 rounded-4">
                                <i class="bi bi-people fs-2 text-primary mb-2"></i>
                                <div class="small text-muted text-uppercase fw-bold">Seats</div>
                                <div class="fw-bold">{{ $car->seats }} People</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6 text-center">
                            <div class="bg-light p-3 rounded-4">
                                <i class="bi bi-briefcase fs-2 text-primary mb-2"></i>
                                <div class="small text-muted text-uppercase fw-bold">Luggage</div>
                                <div class="fw-bold">{{ $car->luggage }} Bags</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6 text-center">
                            <div class="bg-light p-3 rounded-4">
                                <i class="bi bi-snow fs-2 text-primary mb-2"></i>
                                <div class="small text-muted text-uppercase fw-bold">Air Condition</div>
                                <div class="fw-bold">{{ $car->air_conditioning ? 'Yes' : 'No' }}</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6 text-center">
                            <div class="bg-light p-3 rounded-4">
                                <i class="bi bi-palette fs-2 text-primary mb-2"></i>
                                <div class="small text-muted text-uppercase fw-bold">Exterior Color</div>
                                <div class="fw-bold">{{ $car->color ?: 'Standard' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-5">
                    <h4 class="fw-bold mb-3">About this Car</h4>
                    <p class="text-muted mb-0">{{ $car->description ?: 'No description available for this vehicle yet.' }}</p>
                </div>

                <!-- Reviews -->
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold mb-0">Customer Reviews</h4>
                        <div class="text-warning">
                            <i class="bi bi-star-fill"></i> <span class="text-dark fw-bold ms-1">{{ $car->rating }} ({{ $car->reviews_count }} reviews)</span>
                        </div>
                    </div>
                    @if($car->reviews->isEmpty())
                        <p class="text-muted mb-0">No reviews yet for this car. Be the first to rent and review!</p>
                    @else
                        <!-- Review list -->
                        @foreach($car->reviews as $review)
                             <div class="mb-4 border-bottom pb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="fw-bold">{{ $review->user->name }}</div>
                                    <div class="text-warning">
                                        @for($i=1; $i<=5; $i++)
                                            <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                                <div class="text-muted small mb-2">{{ $review->created_at->format('M d, Y') }}</div>
                                <p class="mb-0">{{ $review->comment }}</p>
                             </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Right: Price & Booking Card -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-lg rounded-4 p-4 sticky-top" style="top: 100px;">
                    <div class="text-center mb-4 pb-4 border-bottom">
                        <h2 class="fw-bold text-primary mb-0">{{ number_format($car->price_per_day) }} MAD</h2>
                        <span class="text-muted small font-weight-bold">PER DAY</span>
                        @if($car->is_available)
                            <div class="mt-2 text-success small fw-bold"><i class="bi bi-check-circle-fill me-1"></i> AVAILABLE NOW</div>
                        @else
                            <div class="mt-2 text-danger small fw-bold"><i class="bi bi-x-circle-fill me-1"></i> CURRENTLY UNAVAILABLE</div>
                        @endif
                    </div>

                    <form action="{{ route('bookings.create') }}" method="GET">
                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">Pickup Location</label>
                            <select name="pickup_location" class="form-select bg-light border-0 py-2 shadow-none" required>
                                <option value="">Select Pickup Point</option>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}">{{ $loc->full_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row g-2 mb-4">
                            <div class="col-6">
                                <label class="form-label fw-bold small text-uppercase">Pickup Date</label>
                                <input type="date" name="pickup_date" class="form-control bg-light border-0 py-2 shadow-none" required min="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-bold small text-uppercase">Return Date</label>
                                <input type="date" name="return_date" class="form-control bg-light border-0 py-2 shadow-none" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                            </div>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold shadow-sm" {{ !$car->is_available ? 'disabled' : '' }}>
                                BOOK NOW
                            </button>
                        </div>
                        
                        <p class="text-center text-muted small mb-0">No payment required now. Pay on pickup!</p>
                    </form>

                    <div class="mt-5 p-4 rounded-4 bg-primary text-white shadow-sm border border-primary">
                        <h6 class="fw-bold mb-3 d-flex align-items-center"><i class="bi bi-info-circle-fill me-2 fs-5"></i>Rental Information</h6>
                        <ul class="list-unstyled small mb-0 fw-medium text-white-50">
                            <li class="mb-3 d-flex align-items-center"><i class="bi bi-check-circle-fill me-3 fs-5 text-accent" style="color: var(--accent-color);"></i> Free Cancellation (24h)</li>
                            <li class="mb-3 d-flex align-items-center"><i class="bi bi-check-circle-fill me-3 fs-5 text-accent" style="color: var(--accent-color);"></i> 24/7 Roadside Assistance</li>
                            <li class="mb-3 d-flex align-items-center"><i class="bi bi-check-circle-fill me-3 fs-5 text-accent" style="color: var(--accent-color);"></i> Includes Standard Insurance</li>
                            <li class="d-flex align-items-center"><i class="bi bi-check-circle-fill me-3 fs-5 text-accent" style="color: var(--accent-color);"></i> Unlimited Mileage</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Cars -->
        @if($relatedCars->count() > 0)
            <div class="mt-5">
                <hr class="mb-5">
                <h3 class="fw-bold mb-4">Similar Cars You May Like</h3>
                <div class="row g-4">
                    @foreach($relatedCars as $rel)
                        <div class="col-md-3">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                                <img src="{{ $rel->primaryImage ? asset('storage/' . $rel->primaryImage->image_path) : 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?auto=format&fit=crop&q=80&w=800' }}" class="card-img-top" alt="{{ $rel->brand }} {{ $rel->model }}" style="height: 160px; object-fit: cover;">
                                <div class="card-body p-3 text-center">
                                    <h6 class="fw-bold mb-1">{{ $rel->brand }} {{ $rel->model }}</h6>
                                    <div class="text-primary fw-bold mb-3">{{ number_format($rel->price_per_day) }} MAD/day</div>
                                    <a href="{{ route('cars.show', $rel) }}" class="btn btn-primary btn-sm rounded-pill px-4">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
