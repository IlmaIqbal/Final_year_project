<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $primaryKey = 'primaryKey';

    protected $fillable = [
        'primaryKey',
        'name',
        'nic',
        'dob',
        'gender',
        'mobile',
        'address',
        'designation',
        'email',
    ];
}
