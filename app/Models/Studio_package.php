<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio_package extends Model
{
    use HasFactory;

    protected $primaryKey = 'studio_package_id';

    protected $fillable = [
        'studio_id',
        'name',
        'no_of_sheet',
        'album_type',
        'package_price',
        'description',
        'no_of_cameraman',
        'event_type',
        'image',

    ];

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }

    public function details()
    {
        return $this->hasMany(Studio_package_details::class, 'studio_package_id');
    }
}
