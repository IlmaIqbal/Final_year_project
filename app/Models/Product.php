<?php

namespace App\Models;

use FontLib\Table\Type\name;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $primaryKey = 'id';
    protected $guarded = [];

    // protected $fillable = [
    //     'product_type',
    //     'name',
    //     'detail',
    //     'category',
    //     'reorder_level',
    //     'image',
    //     'active',


    // ];
}
