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
            $table->string('State', 50);
            $table->string('Region', 50);
            $table->string('Town', 50);
            $table->string('Street', 50);
            $table->integer('Number');
            $table->enum('Type', ['House', 'Apartment', 'Premises_Utility']);
            $table->decimal('Surface', 6, 0);
            $table->integer('Number_of_rooms');
            $table->integer('Floor')->nullable();
            $table->string('Construction_type', 50);
            $table->string('Technical_condition', 50);
            $table->string('Furnishings', 50);
            $table->timestamps(); // dodane timestamps dla Laravel
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
