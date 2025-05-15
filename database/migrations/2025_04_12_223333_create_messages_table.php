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
        Schema::create('messages', function (Blueprint $table) {
            $table->id('id'); // Zachowane oryginalne nazewnictwo dla kolumny id
            $table->unsignedBigInteger('id_sender');
            $table->unsignedBigInteger('id_recipient');
            $table->unsignedBigInteger('id_offer');
            $table->text('text');
            $table->date('sent_date');
            $table->timestamps(); // dodane timestamps dla Laravel

            $table->foreign('id_sender')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_recipient')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_offer')->references('id')->on('offers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
