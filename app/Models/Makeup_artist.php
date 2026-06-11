<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makeup_artist extends Model
{
    use HasFactory;

    protected $primaryKey = 'makeup_artist_id';

    protected $fillable = [
        'makeup_artist_id',
        'name',
        'mobile',
        'land',
        'email',
        'address',
        'division_id',
        'provider_id',

    ];

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
    public function provider()
    {
        return $this->belongsTo(Service_Provider::class, 'provider_id');
    }
    public function makeup_artist_package()
    {
        return $this->hasMany(Makeup_artist_package::class, 'makeup_artist_id');
    }
}
