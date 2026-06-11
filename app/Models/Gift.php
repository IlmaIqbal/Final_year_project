<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'detail',
        'image',
        'quantity',
        'price',
        'active',
        'category',

    ];

    public function inventories()
    {
        return $this->morphMany(Inventory::class, 'product');
    }
}
