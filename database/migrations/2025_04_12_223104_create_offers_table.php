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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_owner');
            $table->unsignedBigInteger('id_property');
            $table->string('offer_title', 150);
            $table->text('description');
            $table->integer('price');
            $table->integer('deposit');
            $table->decimal('rent', 10, 0);
            $table->timestamps(); // dodane timestamps dla Laravel

            $table->foreign('id_owner')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_property')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
