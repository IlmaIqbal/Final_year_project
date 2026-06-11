<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_hall extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'booking_id',
        'hall_package_id',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'no_of_head',
        'price_type',
        'unit_price',
        'actual_start_date',
        'actual_start_time',
        'actual_end_date',
        'actual_end_time',
        'type_of_extra',
        'status'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
    public function hall_package()
    {
        return $this->belongsTo(Hall_package::class, 'hall_package_id');
    }
}
