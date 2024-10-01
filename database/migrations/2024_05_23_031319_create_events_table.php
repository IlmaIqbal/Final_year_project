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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->text('description')->nullable();
            $table->integer('guest_no');
            $table->string('event_type');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->unsignedBigInteger('venue_id'); // Foreign key column
            $table->foreign('venue_id') // Define the foreign key
                ->references('id') // References the id column
                ->on('venues') // On the venues table
                ->onDelete('cascade');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
