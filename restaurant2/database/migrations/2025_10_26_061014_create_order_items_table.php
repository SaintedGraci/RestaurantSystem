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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // 🔗 Relationships
            $table->foreignId('order_id')
                  ->constrained('orders')
                  ->onDelete('cascade'); // Delete items when order is deleted

            $table->foreignId('menu_item_id')
                  ->constrained('menu_items')
                  ->onDelete('cascade'); // Delete order item if menu item is deleted

            // 🧾 Item Details
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2); // price at time of order

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
