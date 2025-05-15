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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_property');
            $table->unsignedBigInteger('id_owner');
            $table->unsignedBigInteger('id_user');
            $table->date('transaction_date');
            $table->timestamps(); // dodane timestamps dla Laravel

            $table->foreign('id_property')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('id_owner')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
