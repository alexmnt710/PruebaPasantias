<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_id',
    ];

    // Relación con el país
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Relación con propiedades
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}

