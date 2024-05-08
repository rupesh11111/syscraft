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
            $table->unsignedBigInteger('order_id'); // (Foreign Key referencing Orders Table)
            $table->unsignedBigInteger('product_id'); // (Foreign Key referencing Products Table)
            $table->integer('quantity');
            $table->float('price');

            $table->foreign(['order_id'], 'order_items_orders_ibfk_4')->references(['id'])->on('orders')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign(['product_id'], 'order_items_products_ibfk_4')->references(['id'])->on('products')->onUpdate('CASCADE')->onDelete('set null');

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
