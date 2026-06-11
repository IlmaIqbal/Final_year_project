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

        $tables = ['provinces', 'districts', 'divisions'];

        foreach ($tables as $multiple_tables) {
            Schema::table($multiple_tables, function (Blueprint $table) {
                $table->boolean('status')->default(1);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['provinces', 'districts', 'divisions'];

        foreach ($tables as $multiple_tables) {
            Schema::table($multiple_tables, function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};
