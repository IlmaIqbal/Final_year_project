<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',

        'customer_name',
        'customer_email',
        'phone_no',

        'event_type',
        'guest_no',
        'start_date',
        'end_date',

        'venue_id',
        'venue_name',
        'venue_location',
        'venue_price',

        'catering_id',
        'catering_name',
        'catering_price',

        'decoration_id',
        'decoration_name',
        'decoration_price',

        'entertainment_id',
        'entertainment_name',
        'entertainment_price',
        'total_price',
        'status',
    ];
}
