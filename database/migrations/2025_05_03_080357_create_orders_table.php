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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('landmark')->nullable();
            $table->string('phone');
            $table->decimal('total', 10, 2);
            $table->unsignedBigInteger('u_id'); // user ID
            $table->string('payment_status'); // 'Paid' or 'Cash on Delivery'
            $table->enum('order_status', ['Confirmed', 'Preparing', 'Waiting for Delivery'])->default('Confirmed');
            $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

