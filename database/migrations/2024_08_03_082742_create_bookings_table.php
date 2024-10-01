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
        Schema::create('bookings', function (Blueprint $table) {

            $table->id();
            $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->string('event_type')->nullable();
            $table->string('guest_no')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->string('venue_id')->nullable();
            $table->string('venue_name')->nullable();
            $table->string('location')->nullable();
            $table->string('venue_price')->nullable();

            $table->string('catering_service_id')->nullable();
            $table->string('catering_name')->nullable();
            $table->string('catering_price')->nullable();
            $table->string('decoration_id')->nullable();
            $table->string('decoration_name')->nullable();
            $table->string('decoration_price')->nullable();
            $table->string('entertainment_id')->nullable();
            $table->string('entertainment_name')->nullable();
            $table->string('entertainment_price')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
