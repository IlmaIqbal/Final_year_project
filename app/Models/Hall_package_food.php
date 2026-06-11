<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall_package_food extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'hall_package_id',
        'food_id'

    ];

    public function hall_package()
    {
        return $this->belongsTo(Hall_package::class, 'hall_package_id');
    }

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
}
