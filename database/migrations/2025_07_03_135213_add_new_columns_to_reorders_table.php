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
        Schema::table('reorders', function (Blueprint $table) {
            $table->timestamp('Reorder_confirm_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reorders', function (Blueprint $table) {
            $table->dropColumn('Reorder_confirm_at');
        });
    }
};
