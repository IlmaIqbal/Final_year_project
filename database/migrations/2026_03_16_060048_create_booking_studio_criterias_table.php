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
        Schema::create('booking_studio_criterias', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_id');
            $table->foreign('booking_id')
                ->references('id')
                ->on('bookings')->onDelete('cascade');
            $table->unsignedBigInteger('studio_package_id');
            $table->foreign('studio_package_id')
                ->references('studio_package_id')
                ->on('studio_packages')->onDelete('cascade');
            $table->unsignedBigInteger('studio_package_details_id');
            $table->foreign('studio_package_details_id')
                ->references('studio_package_details_id')
                ->on('studio_package_details')->onDelete('cascade');
            $table->float('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_studio_criterias');
    }
};
