@extends('layouts.admin')

@section('page_title', 'Manage Fleet')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex gap-3">
        <form action="{{ route('admin.cars.index') }}" method="GET" class="d-flex">
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-white border-0"><i class="bi bi-search text-muted"></i></span>
                <input type="text" name="search" class="form-control border-0 py-2" placeholder="Brand or model..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary px-4 fw-bold">Filter</button>
            </div>
        </form>
    </div>
    <a href="{{ route('admin.cars.create') }}" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
        <i class="bi bi-plus-lg me-2"></i>ADD NEW CAR
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr class="text-muted small text-uppercase fw-bold">
                    <th class="ps-4 border-0 py-3">ID</th>
                    <th class="border-0 py-3">Vehicle</th>
                    <th class="border-0 py-3">Specs</th>
                    <th class="border-0 py-3">Price/Day</th>
                    <th class="border-0 py-3">Inventory</th>
                    <th class="border-0 py-3 text-center">Featured</th>
                    <th class="pe-4 border-0 py-3 text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cars as $car)
                    <tr>
                        <td class="ps-4 fw-bold">#{{ $car->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ $car->primaryImage ? asset('storage/' . $car->primaryImage->image_path) : 'https://images.unsplash.com/photo-1542281286-9e0a16bb7366?auto=format&fit=crop&q=80&w=800' }}" class="rounded me-3 shadow-sm" width="70" height="45" style="object-fit: cover;">
                                <div>
                                    <div class="fw-bold">{{ $car->brand }} {{ $car->model }}</div>
                                    <span class="badge bg-secondary opacity-75 small" style="font-size: 0.65rem;">{{ strtoupper($car->type) }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small fw-bold">{{ ucfirst($car->transmission) }} • {{ ucfirst($car->fuel_type) }}</div>
                            <div class="text-muted small">{{ $car->year }} 모델</div>
                        </td>
                        <td>
                            <div class="fw-bold text-primary">{{ number_format($car->price_per_day, 2) }} MAD</div>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.cars.toggle', $car) }}" id="toggleForm{{ $car->id }}">
                                @csrf
                                <div class="form-check form-switch cursor-pointer">
                                    <input class="form-check-input" type="checkbox" onchange="document.getElementById('toggleForm{{ $car->id }}').submit()" {{ $car->is_available ? 'checked' : '' }}>
                                    <label class="form-check-label small fw-bold {{ $car->is_available ? 'text-success' : 'text-danger' }}">
                                        {{ $car->is_available ? 'Available' : 'Unavailable' }}
                                    </label>
                                </div>
                            </form>
                        </td>
                        <td class="text-center">
                            @if($car->is_featured)
                                <i class="bi bi-star-fill text-warning fs-5" title="Featured Car"></i>
                            @else
                                <i class="bi bi-star text-muted opacity-50 fs-5"></i>
                            @endif
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.cars.edit', $car) }}" class="btn btn-light btn-sm rounded-pill px-3 fw-bold">Edit</a>
                                <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Delete this car? This cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 fw-bold">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-car-front fs-1 text-muted mb-3 d-block"></i>
                            <p class="text-muted">No cars added to the fleet yet.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center">
    {{ $cars->links() }}
</div>
@endsection
