<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makeup_artist_package extends Model
{
    use HasFactory;

    protected $primaryKey = 'makeup_artist_package_id';

    protected $fillable = [
        'makeup_artist_package_id',
        'makeup_artist_id',
        'name',
        'package_price',
        'description',
        'event_type',
        'image',

    ];

    public function makeup_artist()
    {
        return $this->belongsTo(Makeup_artist::class, 'makeup_artist_id');
    }

    public function makeup_artist_package_details()
    {
        return $this->hasMany(Makeup_artist_package_detalis::class, 'makeup_artist_package_id');
    }
}
