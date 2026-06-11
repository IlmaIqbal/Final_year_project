<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Termwind\Components\Hr;

class Division extends Model
{
    use HasFactory;

    protected $primaryKey = 'division_id';

    protected $fillable = [
        'name',
        'district_id',
        'status'

    ];
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function studio()
    {
        return $this->hasMany(studio::class, 'district_id');
    }

    public function makeup_artist()
    {
        return $this->hasMany(Makeup_artist::class, 'district_id');
    }
    public function hall()
    {
        return $this->hasMany(Hall::class, 'district_id');
    }
}
