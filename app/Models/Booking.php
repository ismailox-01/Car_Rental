<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_number', 'user_id', 'car_id', 'pickup_location_id', 'dropoff_location_id',
        'pickup_date', 'return_date', 'total_days', 'price_per_day', 'extras_price',
        'discount', 'total_price', 'status', 'extras', 'coupon_code', 'notes',
        'confirmed_at', 'cancelled_at',
    ];

    protected $casts = [
        'pickup_date'   => 'date',
        'return_date'   => 'date',
        'extras'        => 'array',
        'confirmed_at'  => 'datetime',
        'cancelled_at'  => 'datetime',
        'total_price'   => 'decimal:2',
        'price_per_day' => 'decimal:2',
        'extras_price'  => 'decimal:2',
        'discount'      => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function pickupLocation()
    {
        return $this->belongsTo(Location::class, 'pickup_location_id');
    }

    public function dropoffLocation()
    {
        return $this->belongsTo(Location::class, 'dropoff_location_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['pending', 'confirmed'])
            && $this->pickup_date->isFuture();
    }

    public static function generateBookingNumber(): string
    {
        return 'CR-' . strtoupper(uniqid());
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending'   => 'warning',
            'confirmed' => 'success',
            'cancelled' => 'danger',
            'completed' => 'info',
            default     => 'secondary',
        };
    }
}
