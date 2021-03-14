<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'city_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
