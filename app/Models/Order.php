<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'user_address',
        'phone',
        'billing_name',
        'billing_email',
        'billing_address',
        'billing_phone',
        'items',
        'total_price',
        'delivery',
        'payment',
        'payment_method',
        'paid_at',
        'paid_by',
        'vehicle_no',
        'estimate_date',
        'deliver_by',
        'image'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function paidBy()
    {
        return $this->belongsTo(User::class, 'paid_by');
    }
    public function deliverBy()
    {
        return $this->belongsTo(User::class, 'deliver_by');
    }
}
