<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall_package extends Model
{
    use HasFactory;

    protected $primaryKey = 'hall_package_id';

    protected $fillable = [
        'hall_package_id',
        'hall_id',
        'name',
        'description',
        'hall_price',
        'per_head_price',
        'advance',
        'duration',
        'ac',
        'additional_charge_ac',
        'additional_charge_nac',
        'image',

    ];

    public function hall()
    {
        return $this->belongsTo(Hall::class, 'hall_id');
    }
}
