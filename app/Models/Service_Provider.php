<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_Provider extends Model
{
    use HasFactory;

    protected $primaryKey = 'provider_id';

    protected $fillable = [
        'name',
        'nic',
        'mobile',
        'email',
        'address',
        'type',
    ];

    public function studios()
    {
        return $this->hasMany(Studio::class, 'provider_id');
    }

    public function makeup_artist()
    {
        return $this->hasMany(Makeup_artist::class, 'provider_id');
    }

    public function hall()
    {
        return $this->hasMany(Hall::class, 'provider_id');
    }
}
