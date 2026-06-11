<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    protected $primaryKey = 'hall_id';

    protected $fillable = [
        'hall_id',
        'name',
        'mobile',
        'land',
        'email',
        'address',
        'division_id',
        'provider_id',
        'ac',
        'image',

    ];

    public function hall()
    {
        return $this->hasMany(Hall_package::class, 'hall_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function service_provider()
    {
        return $this->belongsTo(Service_Provider::class, 'provider_id');
    }
}
