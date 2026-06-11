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
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('review_id');
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
            $table->string('package_type', 10);
            $table->date('date');
            $table->string('rate', 1);
            $table->text('comment', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
