<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'book_date',
        'customer_id',
        'total_price',
        'offer',
        'additional_price',
        'status',

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
