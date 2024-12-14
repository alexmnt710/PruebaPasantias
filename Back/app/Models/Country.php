<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'iso_code',
    ];

    // Relación con ciudades
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    // Relación con propiedades
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
