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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('brend_id');
            $table->text('comment')->nullable();
            $table->float('total_price');
            $table->unsignedBigInteger('owner_id');

            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('brend_id')->references('id')->on('brends');
            $table->foreign('owner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
