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
            $table->unsignedBigInteger('Id_property');
            $table->unsignedBigInteger('Id_owner');
            $table->unsignedBigInteger('Id_user');
            $table->date('Transaction_date');
            $table->timestamps(); // dodane timestamps dla Laravel

            $table->foreign('Id_property')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('Id_owner')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('Id_user')->references('user_id')->on('users')->onDelete('cascade');
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
