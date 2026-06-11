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
        Schema::create('studio_packages', function (Blueprint $table) {
            $table->bigIncrements('studio_package_id');
            $table->unsignedBigInteger('studio_id');
            $table->foreign('studio_id')
                ->references('studio_id')
                ->on('studios')->onDelete('cascade');
            $table->string('name', 100);
            $table->string('no_of_sheet', 10);
            $table->string('album_type', 100);
            $table->float('package_price', 100);
            $table->string('land', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studio_packages');
    }
};
