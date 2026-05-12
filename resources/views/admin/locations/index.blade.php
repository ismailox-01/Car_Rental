@extends('layouts.admin')

@section('page_title', 'Rental Locations')

@section('content')
<div class="row g-4">
    <!-- List of Locations -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-muted small text-uppercase fw-bold">
                            <th class="ps-4 border-0 py-3">Location Name</th>
                            <th class="border-0 py-3">City / Address</th>
                            <th class="border-0 py-3">Type</th>
                            <th class="border-0 py-3">Status</th>
                            <th class="pe-4 border-0 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($locations as $loc)
                            <tr>
                                <td class="ps-4 fw-bold">{{ $loc->name }}</td>
                                <td>
                                    <div class="fw-bold small">{{ $loc->city }}</div>
                                    <div class="text-muted small">{{ $loc->address }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark opacity-75 small">{{ ucfirst($loc->type) }}</span>
                                </td>
                                <td>
                                    @if($loc->is_active)
                                        <span class="badge bg-success rounded-pill px-3">Active</span>
                                    @else
                                        <span class="badge bg-danger rounded-pill px-3">Inactive</span>
                                    @endif
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.locations.edit', $loc) }}" class="btn btn-light btn-sm rounded-pill px-3">Edit</a>
                                        <form action="{{ route('admin.locations.destroy', $loc) }}" method="POST" onsubmit="return confirm('Delete this location?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add/Edit Form -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h5 class="fw-bold mb-4">{{ isset($location) ? 'Update Location' : 'Add New Location' }}</h5>
            <form action="{{ isset($location) ? route('admin.locations.update', $location) : route('admin.locations.store') }}" method="POST">
                @csrf
                @if(isset($location)) @method('PUT') @endif

                <div class="mb-3">
                    <label class="form-label fw-bold small text-uppercase">Location Name</label>
                    <input type="text" name="name" class="form-control bg-light border-0 py-2 shadow-none" required value="{{ old('name', $location->name ?? '') }}" placeholder="e.g. JFK Airport Terminal 1">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-uppercase">City</label>
                    <input type="text" name="city" class="form-control bg-light border-0 py-2 shadow-none" required value="{{ old('city', $location->city ?? '') }}" placeholder="e.g. New York">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-uppercase">Full Address</label>
                    <textarea name="address" class="form-control bg-light border-0 py-2 shadow-none" rows="2" required placeholder="Street name and number...">{{ old('address', $location->address ?? '') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold small text-uppercase">Type</label>
                    <select name="type" class="form-select bg-light border-0 py-2 shadow-none" required>
                        <option value="airport" {{ (old('type', $location->type ?? '') == 'airport') ? 'selected' : '' }}>Airport Office</option>
                        <option value="downtown" {{ (old('type', $location->type ?? '') == 'downtown') ? 'selected' : '' }}>Downtown Office</option>
                        <option value="hotel" {{ (old('type', $location->type ?? '') == 'hotel') ? 'selected' : '' }}>Hotel Desk</option>
                    </select>
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="activeLoc" {{ old('is_active', $location->is_active ?? 1) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold small text-uppercase" for="activeLoc">Location is Active</label>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill py-2 fw-bold shadow-sm">
                        {{ isset($location) ? 'UPDATE LOCATION' : 'CREATE LOCATION' }}
                    </button>
                    @if(isset($location))
                        <a href="{{ route('admin.locations.index') }}" class="btn btn-light rounded-pill py-2 fw-bold border">CANCEL</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
