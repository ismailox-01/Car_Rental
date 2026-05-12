<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id', 'amount', 'method', 'status', 'transaction_id', 'payment_data', 'paid_at',
    ];

    protected $casts = [
        'amount'       => 'decimal:2',
        'payment_data' => 'array',
        'paid_at'      => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
