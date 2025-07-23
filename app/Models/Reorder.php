<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reorder extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'supplier_id',
        'requested_qty',
        'status',
        'supplier_approved',
        'Reorder_confirm_at',
        'supplier_approved_at'


    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}