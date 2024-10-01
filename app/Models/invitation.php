<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'active',
    ];
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_decoration_service');
    }
}
