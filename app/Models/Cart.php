<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address1',
        'address2',
        'product_name',
        'image',
        'quantity',
        'price',
        'product_id',
        'user_id',

    ];
}
