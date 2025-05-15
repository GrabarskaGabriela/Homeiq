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
            $table->string('state', 50);
            $table->string('segion', 50);
            $table->string('town', 50);
            $table->string('street', 50);
            $table->integer('sumber');
            $table->enum('type', ['house', 'apartment', 'premises_Utility']);
            $table->decimal('surface', 6, 0);
            $table->integer('number_of_rooms');
            $table->integer('floor')->nullable();
            $table->string('construction_type', 50);
            $table->string('technical_condition', 50);
            $table->string('furnishings', 50);
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
