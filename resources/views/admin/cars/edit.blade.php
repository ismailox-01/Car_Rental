@extends('layouts.admin')

@section('page_title', 'Edit Car: ' . $car->brand . ' ' . $car->model)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
            <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4 mb-5">
                    <div class="col-12">
                        <h5 class="fw-bold mb-0 border-bottom pb-3"><i class="bi bi-info-circle me-2"></i>Basic Information</h5>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold small text-uppercase">Brand</label>
                        <input type="text" name="brand" class="form-control bg-light border-0 py-2 shadow-none" required value="{{ old('brand', $car->brand) }}" placeholder="e.g. Toyota">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold small text-uppercase">Model</label>
                        <input type="text" name="model" class="form-control bg-light border-0 py-2 shadow-none" required value="{{ old('model', $car->model) }}" placeholder="e.g. Camry">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold small text-uppercase">Year</label>
                        <input type="number" name="year" class="form-control bg-light border-0 py-2 shadow-none" required value="{{ old('year', $car->year) }}" min="2000" max="{{ date('Y') + 1 }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold small text-uppercase">Price/Day (MAD)</label>
                        <input type="number" name="price_per_day" class="form-control bg-light border-0 py-2 shadow-none" required value="{{ old('price_per_day', $car->price_per_day) }}" min="1">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold small text-uppercase">Type</label>
                        <select name="type" class="form-select bg-light border-0 py-2 shadow-none" required>
                            @foreach(['sedan', 'suv', 'luxury', 'economy', 'van', 'convertible', 'truck'] as $type)
                                <option value="{{ $type }}" {{ (old('type', $car->type) == $type) ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold small text-uppercase">Transmission</label>
                        <select name="transmission" class="form-select bg-light border-0 py-2 shadow-none" required>
                            <option value="automatic" {{ (old('transmission', $car->transmission) == 'automatic') ? 'selected' : '' }}>Automatic</option>
                            <option value="manual" {{ (old('transmission', $car->transmission) == 'manual') ? 'selected' : '' }}>Manual</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold small text-uppercase">Fuel Type</label>
                        <select name="fuel_type" class="form-select bg-light border-0 py-2 shadow-none" required>
                            @foreach(['petrol', 'diesel', 'electric', 'hybrid'] as $fuel)
                                <option value="{{ $fuel }}" {{ (old('fuel_type', $car->fuel_type) == $fuel) ? 'selected' : '' }}>{{ ucfirst($fuel) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold small text-uppercase">License Plate</label>
                        <input type="text" name="license_plate" class="form-control bg-light border-0 py-2 shadow-none" required value="{{ old('license_plate', $car->license_plate) }}" placeholder="A-12345">
                    </div>
                </div>

                <div class="row g-4 mb-5">
                    <div class="col-12">
                        <h5 class="fw-bold mb-0 border-bottom pb-3"><i class="bi bi-gear me-2"></i>Features & Specs</h5>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold small text-uppercase">Seats</label>
                        <input type="number" name="seats" class="form-control bg-light border-0 py-2 shadow-none" required value="{{ old('seats', $car->seats) }}" min="1">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold small text-uppercase">Luggage (Bags)</label>
                        <input type="number" name="luggage" class="form-control bg-light border-0 py-2 shadow-none" required value="{{ old('luggage', $car->luggage) }}" min="0">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold small text-uppercase">Color</label>
                        <input type="text" name="color" class="form-control bg-light border-0 py-2 shadow-none" value="{{ old('color', $car->color) }}" placeholder="e.g. Silver Metallic">
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch mt-4 pt-2">
                            <input class="form-check-input" type="checkbox" name="air_conditioning" value="1" id="acSwitch" {{ old('air_conditioning', $car->air_conditioning) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold small text-uppercase" for="acSwitch">Air Conditioning</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold small text-uppercase">Description</label>
                        <textarea name="description" class="form-control bg-light border-0 py-2 shadow-none" rows="4" placeholder="Describe the vehicle's unique selling points...">{{ old('description', $car->description) }}</textarea>
                    </div>
                </div>

                <div class="row g-4 mb-5">
                    <div class="col-12">
                        <h5 class="fw-bold mb-0 border-bottom pb-3"><i class="bi bi-images me-2"></i>Vehicle Photos</h5>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold small text-uppercase">Upload New Images</label>
                        <div class="p-4 border-2 border-dashed rounded-4 bg-light text-center cursor-pointer" onclick="document.getElementById('carImages').click()">
                            <i class="bi bi-cloud-arrow-up fs-1 text-primary"></i>
                            <p class="mb-0 mt-2 text-muted small">Drop files here or click to upload</p>
                            <input type="file" name="images[]" id="carImages" multiple class="d-none" accept="image/*">
                        </div>
                    </div>
                    @if($car->images->count() > 0)
                        <div class="col-12">
                            <label class="form-label fw-bold small text-uppercase d-block mb-3">Current Images</label>
                            <div class="row g-3">
                                @foreach($car->images as $img)
                                    <div class="col-md-3 col-6">
                                        <div class="position-relative">
                                            <img src="{{ asset('storage/' . $img->image_path) }}" class="img-fluid rounded-4 shadow-sm" style="height: 120px; width: 100%; object-fit: cover;">
                                            <button type="button" class="btn btn-danger btn-sm rounded-circle position-absolute top-0 end-0 m-2 shadow-sm"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="row g-4 mb-5">
                    <div class="col-12">
                        <h5 class="fw-bold mb-0 border-bottom pb-3"><i class="bi bi-toggle-on me-2"></i>Visibility & Status</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check form-switch bg-light p-3 rounded-4 ps-5">
                            <input class="form-check-input ms-0 me-3" type="checkbox" name="is_available" value="1" id="availSwitch" {{ old('is_available', $car->is_available) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="availSwitch">Show as Available for Rent</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check form-switch bg-light p-3 rounded-4 ps-5">
                            <input class="form-check-input ms-0 me-3" type="checkbox" name="is_featured" value="1" id="featSwitch" {{ old('is_featured', $car->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="featSwitch">Mark as Featured (Shown on Homepage)</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 pt-4 border-top">
                    <a href="{{ route('admin.cars.index') }}" class="btn btn-light rounded-pill px-5 fw-bold">CANCEL</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                        SAVE CHANGES
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .border-dashed {
        border-style: dashed !important;
    }
</style>
@endsection
