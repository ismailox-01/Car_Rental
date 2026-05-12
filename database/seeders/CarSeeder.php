<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $cars = [
            // Sedans
            ['brand' => 'Toyota',     'model' => 'Camry',         'year' => 2024, 'type' => 'sedan',      'transmission' => 'automatic', 'fuel_type' => 'petrol',   'seats' => 5, 'luggage' => 3, 'price_per_day' => 650.00,  'color' => 'Silver',  'is_featured' => true,  'description' => 'Comfortable and reliable mid-size sedan perfect for city and highway driving.'],
            ['brand' => 'Honda',      'model' => 'Accord',        'year' => 2024, 'type' => 'sedan',      'transmission' => 'automatic', 'fuel_type' => 'hybrid',   'seats' => 5, 'luggage' => 3, 'price_per_day' => 700.00,  'color' => 'White',   'is_featured' => true,  'description' => 'Fuel-efficient hybrid sedan with advanced safety features.'],
            ['brand' => 'Hyundai',    'model' => 'Sonata',        'year' => 2023, 'type' => 'sedan',      'transmission' => 'automatic', 'fuel_type' => 'petrol',   'seats' => 5, 'luggage' => 3, 'price_per_day' => 580.00,  'color' => 'Blue',    'is_featured' => false, 'description' => 'Stylish sedan with spacious interior and modern technology.'],

            // SUVs
            ['brand' => 'Toyota',     'model' => 'RAV4',          'year' => 2024, 'type' => 'suv',        'transmission' => 'automatic', 'fuel_type' => 'hybrid',   'seats' => 5, 'luggage' => 5, 'price_per_day' => 950.00,  'color' => 'Gray',    'is_featured' => true,  'description' => 'Popular hybrid SUV offering great fuel economy and ample cargo space.'],
            ['brand' => 'Ford',       'model' => 'Explorer',      'year' => 2024, 'type' => 'suv',        'transmission' => 'automatic', 'fuel_type' => 'petrol',   'seats' => 7, 'luggage' => 6, 'price_per_day' => 1100.00, 'color' => 'Black',   'is_featured' => true,  'description' => 'Spacious 7-seater SUV ideal for family trips.'],
            ['brand' => 'Chevrolet',  'model' => 'Equinox',       'year' => 2023, 'type' => 'suv',        'transmission' => 'automatic', 'fuel_type' => 'petrol',   'seats' => 5, 'luggage' => 4, 'price_per_day' => 850.00,  'color' => 'Red',     'is_featured' => false, 'description' => 'Versatile compact SUV with excellent cargo space.'],
            ['brand' => 'BMW',        'model' => 'X5',            'year' => 2024, 'type' => 'suv',        'transmission' => 'automatic', 'fuel_type' => 'petrol',   'seats' => 5, 'luggage' => 5, 'price_per_day' => 1800.00, 'color' => 'White',   'is_featured' => true,  'description' => 'Premium luxury SUV with outstanding performance and comfort.'],

            // Economy
            ['brand' => 'Toyota',     'model' => 'Yaris',         'year' => 2023, 'type' => 'economy',    'transmission' => 'manual',    'fuel_type' => 'petrol',   'seats' => 5, 'luggage' => 2, 'price_per_day' => 400.00,  'color' => 'Yellow',  'is_featured' => false, 'description' => 'Budget-friendly compact car, great for city navigation.'],
            ['brand' => 'Kia',        'model' => 'Rio',           'year' => 2023, 'type' => 'economy',    'transmission' => 'automatic', 'fuel_type' => 'petrol',   'seats' => 5, 'luggage' => 2, 'price_per_day' => 380.00,  'color' => 'Orange',  'is_featured' => false, 'description' => 'Affordable and efficient subcompact car.'],
            ['brand' => 'Chevrolet',  'model' => 'Spark',         'year' => 2022, 'type' => 'economy',    'transmission' => 'automatic', 'fuel_type' => 'petrol',   'seats' => 4, 'luggage' => 1, 'price_per_day' => 320.00,  'color' => 'Blue',    'is_featured' => false, 'description' => 'Ultra-compact car perfect for solo travelers in the city.'],

            // Luxury
            ['brand' => 'Mercedes',   'model' => 'E-Class',       'year' => 2024, 'type' => 'luxury',     'transmission' => 'automatic', 'fuel_type' => 'petrol',   'seats' => 5, 'luggage' => 3, 'price_per_day' => 2200.00, 'color' => 'Black',   'is_featured' => true,  'description' => 'Iconic luxury sedan with premium materials and cutting-edge technology.'],
            ['brand' => 'Audi',       'model' => 'A6',            'year' => 2024, 'type' => 'luxury',     'transmission' => 'automatic', 'fuel_type' => 'petrol',   'seats' => 5, 'luggage' => 3, 'price_per_day' => 2000.00, 'color' => 'Gunmetal','is_featured' => true,  'description' => 'Executive sedan with refined performance and Quattro AWD.'],
            ['brand' => 'Tesla',      'model' => 'Model S',       'year' => 2024, 'type' => 'luxury',     'transmission' => 'automatic', 'fuel_type' => 'electric',  'seats' => 5, 'luggage' => 3, 'price_per_day' => 2500.00, 'color' => 'White',   'is_featured' => true,  'description' => 'All-electric luxury sedan with incredible range and autopilot.'],

            // Van
            ['brand' => 'Chrysler',   'model' => 'Pacifica',      'year' => 2023, 'type' => 'van',        'transmission' => 'automatic', 'fuel_type' => 'petrol',   'seats' => 8, 'luggage' => 8, 'price_per_day' => 1300.00, 'color' => 'Silver',  'is_featured' => false, 'description' => 'Spacious family minivan with stow-and-go seating.'],
            ['brand' => 'Volkswagen', 'model' => 'Transporter',   'year' => 2023, 'type' => 'van',        'transmission' => 'automatic', 'fuel_type' => 'diesel',   'seats' => 9, 'luggage' => 10,'price_per_day' => 1500.00, 'color' => 'White',   'is_featured' => false, 'description' => 'Large capacity van perfect for group travel.'],
        ];

        foreach ($cars as $carData) {
            Car::create(array_merge($carData, [
                'air_conditioning' => true,
                'is_available'     => true,
                'rating'           => round(mt_rand(38, 50) / 10, 1),
                'reviews_count'    => mt_rand(5, 150),
            ]));
        }
    }
}
