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
        Schema::create('studio_package_details', function (Blueprint $table) {
            $table->bigIncrements('studio_package_details_id');
            $table->unsignedBigInteger('studio_package_id');
            $table->foreign('studio_package_id')
                ->references('studio_package_id')
                ->on('studio_packages')->onDelete('cascade');
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
        Schema::dropIfExists('studio_package_details');
    }
};
