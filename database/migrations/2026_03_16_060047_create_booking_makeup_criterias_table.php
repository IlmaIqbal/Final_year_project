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
        Schema::create('booking_makeup_criterias', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_id');
            $table->foreign('booking_id')
                ->references('id')
                ->on('bookings')->onDelete('cascade');
            $table->unsignedBigInteger('makeup_artist_package_id');
            $table->foreign('makeup_artist_package_id')
                ->references('makeup_artist_package_id')
                ->on('makeup_artist_packages')->onDelete('cascade');
            $table->unsignedBigInteger('makeup_pac_details_id');
            $table->foreign('makeup_pac_details_id')
                ->references('makeup_artist_package_details_id')
                ->on('makeup_artist_package_detalis')->onDelete('cascade');
            $table->float('price');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_makeup_criterias');
    }
};
