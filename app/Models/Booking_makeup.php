<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_makeup extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'booking_id',
        'makeup_artist_package_id',
        'event_date',
        'event_time',
        'package_price',
        'status'
    ];
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function makeup_artist_package()
    {
        return $this->belongsTo(Makeup_artist_package::class, 'makeup_artist_package_id');
    }
}
