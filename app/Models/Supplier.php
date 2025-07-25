<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address1',
        'address2',
        'email',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
