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
            $table->unsignedBigInteger('Id_owner');
            $table->unsignedBigInteger('Id_property');
            $table->string('Offer_title', 150);
            $table->text('Description');
            $table->integer('Price');
            $table->integer('Deposit');
            $table->decimal('Rent', 10, 0);
            $table->timestamps(); // dodane timestamps dla Laravel

            $table->foreign('Id_owner')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('Id_owner')->references('id')->on('properties')->onDelete('cascade');
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
