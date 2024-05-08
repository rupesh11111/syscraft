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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // (Foreign Key referencing Orders Table)
            $table->string('transaction_id');
            $table->float('amount');
            $table->tinyInteger('status')->default(true);

            $table->foreign(['order_id'], 'transactions_orders_ibfk_4')->references(['id'])->on('orders')->onUpdate('CASCADE')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
