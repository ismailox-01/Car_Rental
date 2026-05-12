@extends('layouts.admin')

@section('page_title', 'Customer Profile: ' . $user->name)

@section('content')
<div class="row g-4">
    <!-- Sidebar -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
            <div class="mb-4">
                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=2563eb&color=fff&size=200' }}" class="rounded-circle shadow-sm border border-5 border-white" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
            <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
            <p class="text-muted small mb-4">{{ $user->email }}</p>
            <div class="badge bg-{{ $user->role == 'admin' ? 'dark' : 'primary' }} rounded-pill px-3 py-2 mb-4">
                {{ strtoupper($user->role) }}
            </div>
            
            <div class="row g-2 mb-4">
                <div class="col-6">
                    <div class="p-3 bg-light rounded-4">
                        <div class="fw-bold mb-0">{{ $user->bookings_count }}</div>
                        <div class="text-muted small">Total Bookings</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 bg-light rounded-4">
                        <div class="fw-bold mb-0">{{ number_format($totalSpent) }} MAD</div>
                        <div class="text-muted small">Total Spent</div>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.users.toggle', $user) }}" method="POST" class="mb-2">
                @csrf
                <button type="submit" class="btn btn-{{ $user->is_active ? 'outline-danger' : 'success' }} w-100 rounded-pill fw-bold">
                    {{ $user->is_active ? 'BLOCK CUSTOMER' : 'ACTIVATE CUSTOMER' }}
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <h5 class="fw-bold mb-4">Customer Details</h5>
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="small text-muted text-uppercase fw-bold mb-1">Phone Number</label>
                    <div class="fw-bold">{{ $user->phone ?: 'N/A' }}</div>
                </div>
                <div class="col-md-6">
                    <label class="small text-muted text-uppercase fw-bold mb-1">Driver License</label>
                    <div class="fw-bold text-primary">{{ $user->license_number ?: 'Not provided' }}</div>
                </div>
                <div class="col-12">
                    <label class="small text-muted text-uppercase fw-bold mb-1">Address</label>
                    <div class="fw-bold">{{ $user->address ?: 'Not provided' }}</div>
                </div>
                <div class="col-md-6">
                    <label class="small text-muted text-uppercase fw-bold mb-1">Account Created</label>
                    <div class="fw-bold">{{ $user->created_at->format('F d, Y') }}</div>
                </div>
                <div class="col-md-6">
                    <label class="small text-muted text-uppercase fw-bold mb-1">Last Updated</label>
                    <div class="fw-bold">{{ $user->updated_at->diffForHumans() }}</div>
                </div>
            </div>
        </div>

        <!-- Booking History -->
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h5 class="fw-bold mb-4">Booking History</h5>
            @if($user->bookings->isEmpty())
                <p class="text-muted mb-0 py-3 text-center">No bookings found for this customer.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr class="small text-muted text-uppercase fw-bold">
                                <th class="border-0">#</th>
                                <th class="border-0">Vehicle</th>
                                <th class="border-0">Dates</th>
                                <th class="border-0">Total</th>
                                <th class="border-0 text-center">Status</th>
                                <th class="border-0 text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->bookings as $bk)
                                <tr>
                                    <td class="small fw-bold">{{ $bk->booking_number }}</td>
                                    <td>{{ $bk->car->brand }} {{ $bk->car->model }}</td>
                                    <td class="small">{{ $bk->pickup_date->format('M d') }} - {{ $bk->return_date->format('M d') }}</td>
                                    <td class="fw-bold">{{ number_format($bk->total_price) }} MAD</td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $bk->status_badge }} rounded-pill" style="font-size: 0.65rem;">{{ strtoupper($bk->status) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.bookings.show', $bk) }}" class="btn btn-light btn-sm rounded-circle"><i class="bi bi-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
