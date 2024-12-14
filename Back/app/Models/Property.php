<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price_per_night',
        'avaiable',
        'country_id',
        'city_id',
        'type_id',
    ];

    // Relación con el usuario propietario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el país
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Relación con la ciudad
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Relación con las reservas
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}

