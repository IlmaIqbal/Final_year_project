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
        Schema::create('booking_payments', function (Blueprint $table) {
            $table->bigIncrements('payment_id', 10);
            $table->unsignedBigInteger('booking_id');
            $table->foreign('booking_id')
                ->references('id')
                ->on('bookings')->onDelete('cascade');
            $table->unsignedBigInteger('h_package_id');
            $table->foreign('h_package_id')
                ->references('hall_package_id')
                ->on('hall_packages')->onDelete('cascade');

            $table->unsignedBigInteger('s_package_id');
            $table->foreign('s_package_id')
                ->references('studio_package_id')
                ->on('studio_packages')->onDelete('cascade');

            $table->unsignedBigInteger('m_package_id');
            $table->foreign('m_package_id')
                ->references('makeup_artist_package_id')
                ->on('makeup_artist_packages')->onDelete('cascade');
            $table->string('package_type');
            $table->date('pay_date');
            $table->float('amount');
            $table->string('status');
            $table->string('pay_mode');
            $table->string('slip_photo');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_payments');
    }
};
