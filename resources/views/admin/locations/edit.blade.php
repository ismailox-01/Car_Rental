@extends('layouts.admin')

@section('page_title', 'Edit Location')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <h5 class="card-title mb-4">Edit Location: {{ $location->name }}</h5>
        
        <form action="{{ route('admin.locations.update', $location) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Location Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $location->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $location->city) }}" required>
                    @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $location->address) }}">
                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                        <option value="airport" {{ $location->type == 'airport' ? 'selected' : '' }}>Airport</option>
                        <option value="office" {{ $location->type == 'office' ? 'selected' : '' }}>Office</option>
                        <option value="city" {{ $location->type == 'city' ? 'selected' : '' }}>City</option>
                    </select>
                </div>

                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $location->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active Location</label>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-4">Update Location</button>
                    <a href="{{ route('admin.locations.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection