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
<<<<<<< HEAD
=======
        'Reorder_confirm_at',
        'supplier_approved_at'
>>>>>>> f1c4650e72b838410c295a1ed7df16871068ee76


    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> f1c4650e72b838410c295a1ed7df16871068ee76
