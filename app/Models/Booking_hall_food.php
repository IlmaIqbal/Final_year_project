<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_hall_food extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'booking_id',
        'hall_package_id',
        'food_id',
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

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
}
