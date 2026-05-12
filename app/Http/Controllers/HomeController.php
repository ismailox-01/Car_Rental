<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Location;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCars = Car::where('is_featured', true)
            ->where('is_available', true)
            ->with('primaryImage')
            ->take(6)
            ->get();

        $allCars = Car::where('is_available', true)
            ->with('primaryImage')
            ->latest()
            ->take(8)
            ->get();

        $locations = Location::where('is_active', true)->get();

        $stats = [
            'cars'      => Car::where('is_available', true)->count(),
            'locations' => Location::where('is_active', true)->count(),
        ];

        return view('home', compact('featuredCars', 'allCars', 'locations', 'stats'));
    }

    public function search()
    {
        return redirect()->route('cars.index', request()->only([
            'pickup_location', 'dropoff_location', 'pickup_date', 'return_date',
        ]));
    }
}
