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
        Schema::create('offers_pictures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_offer');
            $table->string('path', 255);
            $table->timestamps(); // dodane timestamps dla Laravel

            $table->foreign('id_offer')->references('id')->on('offers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers_pictures');
    }
};
