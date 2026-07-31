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
        Schema::table('car_stocks', function (Blueprint $table) {
            $table->integer('reserved_number')->default(0); // забронировано в корзине
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_stocks', function (Blueprint $table) {
            //
        });
    }
};
