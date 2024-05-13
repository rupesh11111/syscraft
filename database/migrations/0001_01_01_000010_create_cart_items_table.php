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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id'); // (Foreign Key referencing Carts Table)
            $table->unsignedBigInteger('product_id'); // (Foreign Key referencing Products Table)
            $table->integer('quantity')->default(0); 

            $table->foreign(['cart_id'], 'cart_items_carts_ibfk_4')->references(['id'])->on('carts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['product_id'], 'cart_items_products_ibfk_4')->references(['id'])->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
