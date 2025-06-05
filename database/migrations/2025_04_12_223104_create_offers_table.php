<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('property_id');
            $table->string('offer_title', 255);
            $table->enum('offer_type', ['Sprzedaż', 'Wynajem']);
            $table->text('description');
            $table->integer('price');
            $table->integer('deposit');
            $table->integer('rent');
            $table->enum('status', ['available', 'pending', 'unavailable'])->default('available');
            $table->timestamps();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
