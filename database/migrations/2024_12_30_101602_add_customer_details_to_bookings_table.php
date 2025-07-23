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
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('customer_name')->nullable();  // Add customer_name column
            $table->string('customer_email')->nullable(); // Add customer_email column
            $table->string('phone_no')->nullable();       // Add phone_no column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['customer_name', 'customer_email', 'phone_no']); // Drop columns on rollback
        });
    }
};
