<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * عرض قائمة السيارات مع الفلاتر
     */
    public function index(Request $request)
    {
        $query = Car::with('primaryImage')->where('is_available', true);

        // الفلاتر (Filters)
        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%'.$request->brand.'%');
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }
        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->fuel_type);
        }
        if ($request->filled('min_price')) {
            $query->where('price_per_day', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price_per_day', '<=', $request->max_price);
        }

        // فلتر التوفر حسب التاريخ
        if ($request->filled('pickup_date') && $request->filled('return_date')) {
            $pickupDate = $request->pickup_date;
            $returnDate = $request->return_date;

            $query->whereDoesntHave('activeBookings', function ($q) use ($pickupDate, $returnDate) {
                $q->where(function ($q2) use ($pickupDate, $returnDate) {
                    $q2->whereBetween('pickup_date', [$pickupDate, $returnDate])
                       ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                       ->orWhere(function ($q3) use ($pickupDate, $returnDate) {
                           $q3->where('pickup_date', '<=', $pickupDate)
                              ->where('return_date', '>=', $returnDate);
                       });
                });
            });
        }

        // الترتيب (Sorting)
        $sort = $request->get('sort', 'price_asc');
        match($sort) {
            'price_asc'  => $query->orderBy('price_per_day', 'asc'),
            'price_desc' => $query->orderBy('price_per_day', 'desc'),
            'newest'     => $query->orderBy('id', 'desc'),
            'rating'     => $query->orderBy('rating', 'desc'),
            default      => $query->orderBy('price_per_day', 'asc'),
        };

        $cars = $query->paginate(12)->withQueryString();
        $brands = Car::distinct()->pluck('brand')->sort();
        $locations = Location::where('is_active', true)->get();

        return view('cars.index', compact('cars', 'brands', 'locations'));
    }

    /**
     * عرض صفحة إضافة سيارة جديدة
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * حفظ السيارة الجديدة مع التحقق الأمني من الصورة
     */
    public function store(Request $request)
    {
        // التحقق الأمني (Validation)
        $request->validate([
            'brand'         => 'required|string|max:255',
            'model'         => 'required|string|max:255',
            'type'          => 'required|string',
            'price_per_day' => 'required|numeric|min:0',
            // قاعدة حماية الصورة التي طلبتها
            'image'         => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $car = new Car();
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->type = $request->type;
        $car->price_per_day = $request->price_per_day;
        $car->is_available = true; // تعيينها كمتوفرة تلقائياً عند الإضافة

        // معالجة رفع الصورة بأمان
        if ($request->hasFile('image')) {
            // تخزين في storage/app/public/cars وتوليد اسم مشفر للأمان
            $path = $request->file('image')->store('cars', 'public');
            $car->image_url = $path;
        }

        $car->save();

        return redirect()->route('cars.index')->with('success', 'تمت إضافة السيارة بنجاح.');
    }

    /**
     * عرض تفاصيل سيارة محددة
     */
    public function show(Car $car)
    {
        $car->load('images', 'reviews.user');
        $locations = Location::where('is_active', true)->get();
        $relatedCars = Car::where('type', $car->type)
            ->where('id', '!=', $car->id)
            ->where('is_available', true)
            ->with('primaryImage')
            ->take(4)
            ->get();

        return view('cars.show', compact('car', 'locations', 'relatedCars'));
    }
}
