<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Business;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function bussinesses()
    {
        return $this->hasMany(Business::class);
    }

    public function getName() {
        return $this->getAttributeValue('name');
    }
}
