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
        Schema::create('booking_halls', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_id');
            $table->foreign('booking_id')
                ->references('id')
                ->on('bookings')->onDelete('cascade');
            $table->unsignedBigInteger('hall_package_id');
            $table->foreign('hall_package_id')
                ->references('hall_package_id')
                ->on('hall_packages')->onDelete('cascade');
            $table->date('start_date');
            $table->date('start_time');
            $table->date('end_date');
            $table->date('end_time');

            $table->string('no_of_head');
            $table->float('price_type');
            $table->string('unit_price');

            $table->date('actual_start_date');
            $table->date('actual_start_time');
            $table->date('actual_end_date');
            $table->date('actual_end_time');

            $table->string('type_of_extra');
            $table->string('status', 10);

            $table->timestamps();
        });
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_halls');
    }
};
