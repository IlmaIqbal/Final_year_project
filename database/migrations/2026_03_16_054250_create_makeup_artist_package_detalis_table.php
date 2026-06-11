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
        Schema::create('makeup_artist_package_detalis', function (Blueprint $table) {
            $table->bigIncrements('makeup_artist_package_details_id');
            $table->unsignedBigInteger('makeup_artist_package_id');
            $table->foreign('makeup_artist_package_id')
                ->references('makeup_artist_package_id')
                ->on('makeup_artist_packages')->onDelete('cascade');
            $table->string('criteria', 100);
            $table->float('price', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('makeup_artist_package_detalis');
    }
};
