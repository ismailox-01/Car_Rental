<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use App\Models\Location;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_cars'         => Car::count(),
            'available_cars'     => Car::where('is_available', true)->count(),
            'total_bookings'     => Booking::count(),
            'pending_bookings'   => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
            'total_users'        => User::where('role', 'customer')->count(),
            'total_revenue'      => Booking::where('status', '!=', 'cancelled')->sum('total_price'),
            'monthly_revenue'    => Booking::where('status', '!=', 'cancelled')
                                        ->whereMonth('created_at', now()->month)
                                        ->sum('total_price'),
        ];

        $recentBookings = Booking::with('user', 'car')
            ->latest()
            ->take(10)
            ->get();

        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthlyData[] = [
                'month'   => $month->format('M Y'),
                'revenue' => Booking::where('status', '!=', 'cancelled')
                    ->whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->sum('total_price'),
                'bookings' => Booking::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count(),
            ];
        }

        return view('admin.dashboard', compact('stats', 'recentBookings', 'monthlyData'));
    }
}
