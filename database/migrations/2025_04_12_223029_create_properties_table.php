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
            $table->string('country', 50);
            $table->string('region', 50);
            $table->string('town', 50);
            $table->string('postal_code', 10);
            $table->string('street', 50);
            $table->string('building_number',10); //Zmiana z int ponieważ czasami występują numery z literami np. 14A itd
            $table->integer('apartment_number')->nullable();
            $table->enum('type', ['Dom', 'Mieszkanie', 'Lokal użytkowy']);
            $table->decimal('surface', 6, 2);
            $table->integer('number_of_rooms');
            $table->integer('floor');
            $table->enum('technical_condition', ['Do remontu', 'Do kapitalnego remontu', 'Budynek w stanie surowym', 'Gotowy do zamieszkania']);
            $table->enum('furnishings', ['Nieumeblowane', 'Częściowo umeblowane', 'W pełni umeblowane']);
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
