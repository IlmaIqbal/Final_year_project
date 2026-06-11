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
        Schema::create('makeup_artist_packages', function (Blueprint $table) {
            $table->bigIncrements('makeup_artist_package_id');
            $table->unsignedBigInteger('makeup_artist_id');
            $table->foreign('makeup_artist_id')
                ->references('makeup_artist_id')
                ->on('makeup_artists')->onDelete('cascade');
            $table->string('name', 100);
            $table->float('package_price', 100);
            $table->text('description', 100);
            $table->string('event_type', 50);
            $table->string('image', 14);
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('makeup_artist_packages');
    }
};
