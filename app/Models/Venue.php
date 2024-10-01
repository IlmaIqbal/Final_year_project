<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    // The attributes that are mass assignable.
    protected $fillable = [
        'name',
        'image',
        'location',
        'description',
        'capacity',
        'price',
        'active',
    ];

    public function events()

    {
        // Define the one-to-many relationship.
        // This means that each venue can have many events.
        return $this->hasMany(Event::class);
    }
}
