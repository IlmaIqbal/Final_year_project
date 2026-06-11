<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $primaryKey = 'district_id'; // because you used custom PK

    protected $fillable = [
        'name',
        'province_id',
        'status'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function divisions()
    {
        return $this->hasMany(Division::class, 'district_id');
    }
}
