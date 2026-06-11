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
        Schema::create('booking_hall_foods', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_id');
            $table->foreign('booking_id')
                ->references('id')
                ->on('bookings')->onDelete('cascade');
            $table->unsignedBigInteger('hall_package_id');
            $table->foreign('hall_package_id')
                ->references('hall_package_id')
                ->on('hall_packages')->onDelete('cascade');
            $table->unsignedBigInteger('food_id');
            $table->foreign('food_id')
                ->references('food_id')
                ->on('food')->onDelete('cascade');
            $table->string('status', 10);
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_hall_foods');
    }
};
