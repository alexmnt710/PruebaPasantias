<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price_per_night', 10, 2);
            $table->boolean('avaiable');
            $table->foreignId('country_id')->constrained()->onDelete('cascade'); // Relación con la tabla "countries"
            $table->foreignId('city_id')->constrained()->onDelete('cascade'); // Relación con la tabla "cities"
            $table->foreignId('types_id')->constrained('types')->onDelete('cascade'); // Relación con la tabla "types"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
