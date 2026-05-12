@extends('layouts.admin')

@section('page_title', 'Dashboard Overview')

@section('styles')
<style>
    /* No additional styles needed */
</style>
@endsection

@section('content')
<!-- Stats Grid -->
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card stat-card p-4 h-100 bg-white shadow-sm border-0">
            <div class="d-flex justify-content-between mb-4">
                <div class="bg-primary bg-opacity-10 p-3 rounded-4"><i class="bi bi-car-front fs-3 text-primary"></i></div>
                <div class="text-end">
                    <div class="text-muted small fw-bold">TOTAL CARS</div>
                    <div class="fs-2 fw-bold">{{ $stats['total_cars'] }}</div>
                </div>
            </div>
            <div class="small text-success fw-bold"><i class="bi bi-check-circle me-1"></i> {{ $stats['available_cars'] }} available</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-4 h-100 bg-white shadow-sm border-0">
            <div class="d-flex justify-content-between mb-4">
                <div class="bg-warning bg-opacity-10 p-3 rounded-4"><i class="bi bi-calendar-check fs-3 text-warning"></i></div>
                <div class="text-end">
                    <div class="text-muted small fw-bold">BOOKINGS</div>
                    <div class="fs-2 fw-bold">{{ $stats['total_bookings'] }}</div>
                </div>
            </div>
            <div class="small text-muted fw-bold">{{ $stats['pending_bookings'] }} pending approval</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-4 h-100 bg-white shadow-sm border-0">
            <div class="d-flex justify-content-between mb-4">
                <div class="bg-info bg-opacity-10 p-3 rounded-4"><i class="bi bi-people fs-3 text-info"></i></div>
                <div class="text-end">
                    <div class="text-muted small fw-bold">CUSTOMERS</div>
                    <div class="fs-2 fw-bold">{{ $stats['total_users'] }}</div>
                </div>
            </div>
            <div class="small text-muted fw-bold">Active client accounts</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-4 h-100 bg-primary text-white shadow-sm border-0">
            <div class="d-flex justify-content-between mb-4">
                <div class="bg-white bg-opacity-20 p-3 rounded-4"><i class="bi bi-wallet2 fs-3"></i></div>
                <div class="text-end">
                    <div class="text-white bg-opacity-75 small fw-bold text-uppercase">Total Revenue</div>
                    <div class="fs-2 fw-bold">{{ number_format($stats['total_revenue']) }} MAD</div>
                </div>
            </div>
            <div class="small fw-bold">{{ number_format($stats['monthly_revenue']) }} MAD this month</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Revenue Chart -->
    <div class="col-lg-8">
        <div class="card p-4 h-100 shadow-sm border-0">
            <h5 class="fw-bold mb-4">Revenue & Bookings Trend</h5>
            <div style="height: 350px;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Recent Bookings -->
    <div class="col-lg-4">
        <div class="card p-4 h-100 shadow-sm border-0">
            <h5 class="fw-bold mb-4">Recent Bookings</h5>
            <div class="list-group list-group-flush">
                @forelse($recentBookings as $booking)
                    <div class="list-group-item px-0 py-3 border-0 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="{{ $booking->car->primaryImage ? asset('storage/' . $booking->car->primaryImage->image_path) : 'https://ui-avatars.com/api/?name=' . urlencode($booking->user->name) }}" class="rounded me-3" width="45" height="45" style="object-fit: cover;">
                                <div>
                                    <div class="fw-bold small">{{ $booking->user->name }}</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">{{ $booking->car->brand }} {{ $booking->car->model }}</div>
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="fw-bold small text-primary mb-1">{{ number_format($booking->total_price) }} MAD</div>
                                <span class="badge bg-{{ $booking->status_badge }} rounded-pill mb-1" style="font-size: 0.65rem;">{{ strtoupper($booking->status) }}</span>
                                <div class="mt-1">
                                    <a href="{{ route('admin.bookings.show', $booking) }}" class="text-primary small fw-bold text-decoration-none">
                                        <i class="bi bi-eye me-1"></i>View
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted small py-4">No recent bookings found.</p>
                @endforelse
            </div>
            <div class="mt-auto pt-3">
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-light w-100 fw-bold rounded-pill shadow-sm">VIEW ALL BOOKINGS</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // --- Revenue & Bookings Trend Chart ---
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const monthlyData = @json($monthlyData);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: monthlyData.map(d => d.month),
            datasets: [
                {
                    label: 'Revenue (MAD)',
                    data: monthlyData.map(d => d.revenue),
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#2563eb',
                    yAxisID: 'y',
                },
                {
                    label: 'Bookings',
                    data: monthlyData.map(d => d.bookings),
                    borderColor: '#f59e0b',
                    backgroundColor: 'transparent',
                    fill: false,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#f59e0b',
                    yAxisID: 'y1',
                    borderDash: [5, 5],
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: { 
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: { size: 12, weight: 'bold' }
                    }
                },
                tooltip: {
                    padding: 12,
                    backgroundColor: 'rgba(30, 41, 59, 0.9)',
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    beginAtZero: true,
                    title: { display: true, text: 'Revenue (MAD)', font: { weight: 'bold' } },
                    grid: { color: 'rgba(241, 245, 249, 1)' }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    beginAtZero: true,
                    title: { display: true, text: 'Bookings Count', font: { weight: 'bold' } },
                    grid: { drawOnChartArea: false },
                },
                x: { 
                    grid: { display: false }
                }
            }
        }
    });
</script>
@endsection
