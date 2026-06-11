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
        Schema::create('halls', function (Blueprint $table) {
            $table->bigIncrements('hall_id');
            $table->string('name', 100);
            $table->string('mobile', 10);
            $table->string('address', 100);
            $table->string('email', 200);
            $table->string('land', 10);
            $table->unsignedBigInteger('division_id');
            $table->foreign('division_id')
                ->references('division_id')
                ->on('divisions')->onDelete('cascade');
            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id')
                ->references('provider_id')
                ->on('service__providers')->onDelete('cascade');
            $table->string('ac', 10);
            $table->string('image', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('halls');
    }
};
