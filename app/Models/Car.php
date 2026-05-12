<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
    'brand', 'model', 'year', 'type', 'transmission', 'fuel_type',
    'seats', 'luggage', 'price_per_day', 'air_conditioning', 'is_available',
    'is_featured', 'description', 'color', 'license_plate', 'thumbnail',
    'rating', 'reviews_count', 'latitude', 'longitude', 'current_speed',
    'imei' 
];

    protected $casts = [
        'air_conditioning' => 'boolean',
        'is_available'     => 'boolean',
        'is_featured'      => 'boolean',
        'price_per_day'    => 'decimal:2',
        'rating'           => 'float',
    ];

    public function images()
    {
        return $this->hasMany(CarImage::class)->orderBy('sort_order');
    }

    public function primaryImage()
    {
        return $this->hasOne(CarImage::class)->where('is_primary', true);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function activeBookings()
    {
        return $this->hasMany(Booking::class)->whereIn('status', ['pending', 'confirmed']);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('is_approved', true);
    }

    public function isAvailableForDates(string $pickupDate, string $returnDate): bool
    {
        if (!$this->is_available) return false;

        $conflict = $this->activeBookings()
            ->where(function ($q) use ($pickupDate, $returnDate) {
                $q->whereBetween('pickup_date', [$pickupDate, $returnDate])
                  ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                  ->orWhere(function ($q2) use ($pickupDate, $returnDate) {
                      $q2->where('pickup_date', '<=', $pickupDate)
                         ->where('return_date', '>=', $returnDate);
                  });
            })->exists();

        return !$conflict;
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->year} {$this->brand} {$this->model}";
    }
}
