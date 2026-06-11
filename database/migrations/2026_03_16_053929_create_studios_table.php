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
        Schema::create('studios', function (Blueprint $table) {
            $table->bigIncrements('studio_id');
            $table->unsignedBigInteger('division_id');
            $table->foreign('division_id')
                ->references('division_id')
                ->on('divisions')->onDelete('cascade');
            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id')
                ->references('provider_id')
                ->on('service__providers')->onDelete('cascade');
            $table->string('name', 100);
            $table->string('mobile', 10);
            $table->string('land', 10);
            $table->string('email', 200);
            $table->string('address', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studios');
    }
};
