<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = "inventories";
    protected $primaryKey = 'id';
    protected $guarded = [];

    // protected $fillable = [
    //     'product_id',
    //     'product_type',
    //     'supplier_id',
    //     'r_date',
    //     'p_price',
    //     'sell_price',
    //     'qty',
    //     'discount',
    // ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'inventory_id');
    }
}
