<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;

    protected $primaryKey = 'studio_id'; // because you used custom PK

    protected $fillable = [
        'division_id',
        'provider_id',
        'name',
        'mobile',
        'land',
        'email',
        'address'
    ];

    // Relationship with Division
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    // Relationship with Provider
    public function provider()
    {
        return $this->belongsTo(Service_Provider::class, 'provider_id');
    }

    public function packages()
    {
        return $this->hasMany(Studio_Package::class, 'studio_id');
    }
}
