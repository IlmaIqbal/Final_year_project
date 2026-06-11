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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();

            // Polymorphic relation
            $table->unsignedBigInteger('product_id');
            $table->string('product_type');

            // Supplier
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
            $table->date('r_date');
            $table->decimal('p_price', 10, 2); // purchase price
            $table->decimal('sell_price', 10, 2);
            $table->integer('qty');
            $table->decimal('discount', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
