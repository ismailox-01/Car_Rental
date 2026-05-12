<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'discount_percent', 'max_discount', 'max_uses', 'used_count', 'expiry_date', 'is_active',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'expiry_date' => 'date',
    ];

    public function isValid(): bool
    {
        if (!$this->is_active) return false;
        if ($this->max_uses && $this->used_count >= $this->max_uses) return false;
        if ($this->expiry_date && $this->expiry_date->isPast()) return false;
        return true;
    }

    public function calculateDiscount(float $amount): float
    {
        $discount = $amount * ($this->discount_percent / 100);
        if ($this->max_discount) {
            $discount = min($discount, $this->max_discount);
        }
        return round($discount, 2);
    }
}
