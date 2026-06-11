<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makeup_artist_package_detalis extends Model
{
    use HasFactory;

    protected $primaryKey = 'makeup_artist_package_details_id';

    protected $fillable = [
        'makeup_artist_package_details_id',
        'makeup_artist_package_id',
        'criteria',
        'price',

    ];

    public function makeup_artist_package()
    {
        return $this->belongsTo(Makeup_artist_package::class, 'makeup_artist_package_id');
    }
}
