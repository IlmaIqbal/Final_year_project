<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wrapping_paper extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'detail',
        'image',
        'quantity',
        'price',
        'active'
    ];
}
