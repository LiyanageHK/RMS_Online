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
        $table->string('order_status')->default('Confirmed')->change(); // Change the column type from enum to string
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
        $table->enum('order_status', ['Ordered', 'Confirmed', 'Preparing', 'Cancelled'])->default('Confirmed')->change(); // Revert back to enum if needed
    });
    }
};
