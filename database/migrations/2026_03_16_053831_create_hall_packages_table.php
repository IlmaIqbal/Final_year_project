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
        Schema::create('hall_packages', function (Blueprint $table) {
            $table->bigIncrements('hall_package_id');
            $table->unsignedBigInteger('hall_id');
            $table->foreign('hall_id')
                ->references('hall_id')
                ->on('halls')->onDelete('cascade');
            $table->string('name', 100);
            $table->text('description');
            $table->float('hall_price');
            $table->float('per_head_price');
            $table->float('advance');
            $table->integer('duration');
            $table->float('additional_charge_ac');
            $table->float('additional_charge_nac');
            $table->string('image');
            $table->string('ac', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hall_packages');
    }
};
