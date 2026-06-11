<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift_order_items extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'gift_id',
        'no_of_items',
        'status',

    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function gift()
    {
        return $this->belongsTo(Gift::class, 'gift_id');
    }
}
