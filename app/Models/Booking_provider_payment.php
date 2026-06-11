<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_provider_payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'provider_payment_id';

    protected $fillable = [
        'provider_payment_id',
        'booking_id',
        'package_type',
        'package_id',
        'pay_date',
        'amount',
        'status',
        'pay_mode',
        'slip_photo'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function package()
    {
        return $this->morphTo();
    }
}
