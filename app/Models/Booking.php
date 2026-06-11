<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $primaryKey = 'booking_id';

    protected $fillable = [
<<<<<<< HEAD
        'book_date',
        'customer_id',
        'total_price',
        'offer',
        'additional_price',
        'status',

=======
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
>>>>>>> f1c4650e72b838410c295a1ed7df16871068ee76
    ];
    public function halls()
    {
        return $this->hasMany(Booking_hall::class, 'booking_id');
    }

    public function payments()
    {
        return $this->hasMany(Booking_payment::class, 'booking_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'booking_id');
    }
}
