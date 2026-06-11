<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift_order_payment extends Model
{
    use HasFactory;
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'order_id',
        'pay_date',
        'amount',
        'status',
        'pay_mode',
        'slip_photo',

    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
