@extends('layouts.admin')

@section('page_title', 'Customer Management')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
    <div class="p-4 bg-white border-bottom">
        <form action="{{ route('admin.users.index') }}" method="GET" class="row g-3">
            <div class="col-md-6">
                <div class="input-group bg-light rounded-pill overflow-hidden">
                    <span class="input-group-text border-0 bg-transparent"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none py-2" placeholder="Search by name, email or phone..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary px-4 fw-bold">Search</button>
                </div>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr class="text-muted small text-uppercase fw-bold">
                    <th class="ps-4 border-0 py-3">Customer</th>
                    <th class="border-0 py-3">Contact</th>
                    <th class="border-0 py-3">Bookings</th>
                    <th class="border-0 py-3">Status</th>
                    <th class="border-0 py-3">Joined</th>
                    <th class="pe-4 border-0 py-3 text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=2563eb&color=fff' }}" class="rounded-circle me-3" width="45" height="45">
                                <div>
                                    <div class="fw-bold">{{ $user->name }}</div>
                                    <div class="badge bg-{{ $user->role == 'admin' ? 'dark' : 'secondary' }} opacity-75 small" style="font-size: 0.6rem;">{{ strtoupper($user->role) }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small fw-bold"><i class="bi bi-envelope me-2"></i>{{ $user->email }}</div>
                            <div class="text-muted small"><i class="bi bi-telephone me-2"></i>{{ $user->phone ?: 'N/A' }}</div>
                        </td>
                        <td>
                            <div class="fw-bold">{{ $user->bookings_count }}</div>
                            <div class="text-muted small">Total orders</div>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.users.toggle', $user) }}" id="toggleUser{{ $user->id }}">
                                @csrf
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" onchange="document.getElementById('toggleUser{{ $user->id }}').submit()" {{ $user->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label small fw-bold {{ $user->is_active ? 'text-success' : 'text-danger' }}">
                                        {{ $user->is_active ? 'Active' : 'Blocked' }}
                                    </label>
                                </div>
                            </form>
                        </td>
                        <td>
                            <div class="small text-muted">
                                {{ $user->created_at?->format('M d, Y') ?? 'N/A' }}
                            </div>
                        </td>
                        <td class="pe-4 text-end">
                            <div class="btn-group">
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-light btn-sm rounded-pill px-3 me-2">View</a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user? This will also delete their bookings.')">
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

<div class="d-flex justify-content-center">
    {{ $users->links() }}
</div>
@endsection