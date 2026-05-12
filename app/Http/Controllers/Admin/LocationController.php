<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Car; // استيراد واحد فقط في الأعلى
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // إدارة المواقع (التي كانت موجودة سابقاً)
    public function index()
    {
        $locations = Location::withCount(['pickupBookings', 'dropoffBookings'])->latest()->paginate(20);
        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'city'      => 'required|string|max:100',
            'address'   => 'nullable|string|max:500',
            'type'      => 'required|in:airport,office,city',
            'is_active' => 'boolean',
        ]);

        Location::create($validated + ['is_active' => $request->boolean('is_active', true)]);
        return redirect()->route('admin.locations.index')->with('success', 'Location added successfully!');
    }

    public function edit(Location $location)
    {
        return view('admin.locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'city'    => 'required|string|max:100',
            'address' => 'nullable|string|max:500',
            'type'    => 'required|in:airport,office,city',
        ]);

        $location->update($validated + ['is_active' => $request->boolean('is_active', $location->is_active)]);
        return redirect()->route('admin.locations.index')->with('success', 'Location updated!');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('admin.locations.index')->with('success', 'Location deleted.');
    }

}