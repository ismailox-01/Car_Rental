@extends('layouts.admin')

@section('page_title', 'Bookings Management')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
    <!-- Filter Bar -->
    <div class="p-4 bg-white border-bottom">
        <form action="{{ route('admin.bookings.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="small text-muted fw-bold text-uppercase mb-1">Search</label>
                <div class="input-group bg-light rounded-pill overflow-hidden">
                    <span class="input-group-text border-0 bg-transparent"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none py-2" placeholder="Booking # or User name..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <label class="small text-muted fw-bold text-uppercase mb-1">Status</label>
                <select name="status" class="form-select bg-light border-0 py-2 rounded-pill shadow-none">
                    <option value="">All Statuses</option>
                    @foreach(['pending', 'confirmed', 'completed', 'cancelled'] as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold py-2 shadow-sm w-100">Apply filters</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-light rounded-pill px-3 fw-bold py-2 border w-100">Clear</a>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr class="text-muted small text-uppercase fw-bold">
                    <th class="ps-4 border-0 py-3">Booking #</th>
                    <th class="border-0 py-3">Customer</th>
                    <th class="border-0 py-3">Vehicle</th>
                    <th class="border-0 py-3">Dates</th>
                    <th class="border-0 py-3">Total</th>
                    <th class="border-0 py-3 text-center">Status</th>
                    <th class="pe-4 border-0 py-3 text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr>
                        <td class="ps-4 fw-bold text-primary">{{ $booking->booking_number }}</td>
                        <td>
                            <div class="fw-bold">{{ $booking->user->name }}</div>
                            <div class="text-muted small">{{ $booking->user->email }}</div>
                        </td>
                        <td>
                            <div class="fw-bold">{{ $booking->car->brand }} {{ $booking->car->model }}</div>
                            <div class="text-muted small">{{ number_format($booking->car->price_per_day) }} MAD/day</div>
                        </td>
                        <td>
                            <div class="small fw-bold">{{ $booking->pickup_date->format('M d') }} - {{ $booking->return_date->format('M d, Y') }}</div>
                            <div class="small text-muted">{{ $booking->total_days }} days</div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ number_format($booking->total_price, 2) }} MAD</div>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-{{ $booking->status_badge }} rounded-pill px-3">{{ strtoupper($booking->status) }}</span>
                        </td>
                        <td class="pe-4 text-end">
                            <div class="btn-group shadow-sm rounded-pill overflow-hidden">
                                <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-white bg-white border-0 py-1" title="View Details"><i class="bi bi-eye"></i></a>
                                @if($booking->status == 'pending')
                                    <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="btn btn-white bg-white border-0 py-1 text-success" title="Approve"><i class="bi bi-check-circle"></i></button>
                                    </form>
                                @endif
                                @if($booking->status != 'cancelled' && $booking->status != 'completed')
                                    <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn btn-white bg-white border-0 py-1 text-danger" title="Cancel" onclick="return confirm('Cancel this booking?')"><i class="bi bi-x-circle"></i></button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-white bg-white border-0 py-1 text-dark" title="Delete" onclick="return confirm('Delete record permanently?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-calendar-x fs-1 text-muted mb-3 d-block"></i>
                            <p class="text-muted">No bookings found in the system.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center">
    {{ $bookings->links() }}
</div>
@endsection
