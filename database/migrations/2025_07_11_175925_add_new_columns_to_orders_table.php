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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('vehicle_no')->nullable();     // When payment was confirmed
            $table->datetime('estimate_date')->nullable();     // When payment was confirmed
            $table->unsignedBigInteger('deliver_by')->nullable(); // Who confirmed the payment


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('vehicle_no');
            $table->dropColumn('estimate_date');
            $table->dropColumn('deliver_by');
        });
    }
};