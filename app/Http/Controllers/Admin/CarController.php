<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::with('primaryImage');
        if ($request->filled('search')) {
            $query->where('brand', 'like', '%'.$request->search.'%')
                  ->orWhere('model', 'like', '%'.$request->search.'%');
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        $cars = $query->latest()->paginate(15)->withQueryString();
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand'         => 'required|string|max:100',
            'model'         => 'required|string|max:100',
            'year'          => 'required|integer|min:2000|max:'.date('Y')+1,
            'type'          => 'required|in:sedan,suv,luxury,economy,van,convertible,truck',
            'transmission'  => 'required|in:automatic,manual',
            'fuel_type'     => 'required|in:petrol,diesel,electric,hybrid',
            'seats'         => 'required|integer|min:2|max:15',
            'luggage'       => 'required|integer|min:0|max:20',
            'price_per_day' => 'required|numeric|min:1',
            'color'         => 'nullable|string|max:50',
            'description'   => 'nullable|string',
            'images'        => 'nullable|array',
            'images.*'      => 'image|max:5120',
            'air_conditioning' => 'boolean',
            'is_available'  => 'boolean',
            'is_featured'   => 'boolean',
        ]);

        $car = Car::create($validated + [
            'air_conditioning' => $request->boolean('air_conditioning', true),
            'is_available'     => $request->boolean('is_available', true),
            'is_featured'      => $request->boolean('is_featured', false),
        ]);

        // Upload images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $image) {
                $path = $image->store('cars', 'public');
                CarImage::create([
                    'car_id'     => $car->id,
                    'image_path' => $path,
                    'is_primary' => $i === 0,
                    'sort_order' => $i,
                ]);
            }
            $car->update(['thumbnail' => CarImage::where('car_id', $car->id)->where('is_primary', true)->first()?->image_path]);
        }

        return redirect()->route('admin.cars.index')->with('success', 'Car added successfully!');
    }

    public function edit(Car $car)
    {
        $car->load('images');
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'brand'         => 'required|string|max:100',
            'model'         => 'required|string|max:100',
            'year'          => 'required|integer|min:2000|max:'.date('Y')+1,
            'type'          => 'required|in:sedan,suv,luxury,economy,van,convertible,truck',
            'transmission'  => 'required|in:automatic,manual',
            'fuel_type'     => 'required|in:petrol,diesel,electric,hybrid',
            'seats'         => 'required|integer|min:2|max:15',
            'luggage'       => 'required|integer|min:0|max:20',
            'price_per_day' => 'required|numeric|min:1',
            'color'         => 'nullable|string|max:50',
            'description'   => 'nullable|string',
            'images'        => 'nullable|array',
            'images.*'      => 'image|max:5120',
        ]);

        $car->update($validated + [
            'air_conditioning' => $request->boolean('air_conditioning', true),
            'is_available'     => $request->boolean('is_available', $car->is_available),
            'is_featured'      => $request->boolean('is_featured', $car->is_featured),
        ]);

        if ($request->hasFile('images')) {
            $startIndex = $car->images()->count();
            foreach ($request->file('images') as $i => $image) {
                $path = $image->store('cars', 'public');
                CarImage::create([
                    'car_id'     => $car->id,
                    'image_path' => $path,
                    'is_primary' => $startIndex === 0 && $i === 0,
                    'sort_order' => $startIndex + $i,
                ]);
            }
        }

        return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully!');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully!');
    }

    public function toggleAvailability(Car $car)
    {
        $car->update(['is_available' => !$car->is_available]);
        return back()->with('success', 'Car availability updated.');
    }
}
