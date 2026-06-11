<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio_package_details extends Model
{
    use HasFactory;

    protected $primaryKey = 'studio_package_details_id';

    protected $fillable = [
        'studio_package_id',
        'criteria',
        'price',

    ];

    public function package()
    {
        return $this->belongsTo(Studio_Package::class, 'studio_package_id');
    }
}
