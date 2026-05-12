<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'city', 'address', 'type', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function pickupBookings()
    {
        return $this->hasMany(Booking::class, 'pickup_location_id');
    }

    public function dropoffBookings()
    {
        return $this->hasMany(Booking::class, 'dropoff_location_id');
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->name} ({$this->city})";
    }
}
