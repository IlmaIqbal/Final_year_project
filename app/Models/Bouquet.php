<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bouquet extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'detail',
        'image',
        'quantity',
        'price',
        'active',

    ];
    public function inventories()
    {
        return $this->morphMany(Inventory::class, 'product');
    }
}
