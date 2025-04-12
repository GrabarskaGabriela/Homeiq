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
            $table->id('Id'); // Zachowane oryginalne nazewnictwo dla kolumny id
            $table->unsignedBigInteger('Id_sender');
            $table->unsignedBigInteger('Id_recipient');
            $table->unsignedBigInteger('Id_offer');
            $table->text('Text');
            $table->date('Sent_date');
            $table->timestamps(); // dodane timestamps dla Laravel

            $table->foreign('Id_sender')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('Id_recipient')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('Id_offer')->references('id')->on('offers')->onDelete('cascade');
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
