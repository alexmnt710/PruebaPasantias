<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Property;
use App\Models\Reservation;
use App\Models\Type;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Insertar usuarios
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Insertar países
        $mexico = Country::create(['name' => 'Mexico', 'iso_code' => 'MEX']);
        $usa = Country::create(['name' => 'USA', 'iso_code' => 'USA']);
        $canada = Country::create(['name' => 'Canada', 'iso_code' => 'CAN']);

        // Insertar ciudades
        $cancun = City::create(['name' => 'Cancún', 'country_id' => $mexico->id]);
        $guadalajara = City::create(['name' => 'Guadalajara', 'country_id' => $mexico->id]);
        $newYork = City::create(['name' => 'New York', 'country_id' => $usa->id]);
        $toronto = City::create(['name' => 'Toronto', 'country_id' => $canada->id]);

        $airbnb = Type::create(['name' => 'Airbnb']);
        $departamento = Type::create(['name' => 'Departamento']);
        $casa = Type::create(['name' => 'Casa']);

        // Insertar propiedades
        $property1 = Property::create([
            'name' => 'Casa de Playa',
            'price_per_night' => 150.00,
            'avaiable' => true,
            'types_id' => $casa->id,
            'country_id' => $mexico->id,
            'city_id' => $cancun->id,
        ]);

        $property2 = Property::create([
            'name' => 'Departamento en Guadalajara',
            'price_per_night' => 100.00,
            'avaiable' => true,
            'country_id' => $mexico->id,
            'types_id' => $departamento->id,
            'city_id' => $guadalajara->id,
        ]);

        // Insertar reservas
        Reservation::create([
            'user_id' => $user->id,
            'property_id' => $property1->id,
            'start_date' => '2024-12-20',
            'end_date' => '2024-12-25',
            'total_price' => $property1->price_per_night * 5,
        ]);

        Reservation::create([
            'user_id' => $user->id,
            'property_id' => $property2->id,
            'start_date' => '2024-12-28',
            'end_date' => '2025-01-02',
            'total_price' => $property2->price_per_night * 5,
        ]);
    }
}

