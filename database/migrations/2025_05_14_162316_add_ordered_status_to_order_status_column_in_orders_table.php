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
        DB::statement("ALTER TABLE orders CHANGE order_status order_status ENUM('Ordered', 'Confirmed', 'Preparing', 'Waiting for Delivery') DEFAULT 'Ordered'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE orders CHANGE order_status order_status ENUM('Confirmed', 'Preparing', 'Waiting for Delivery') DEFAULT 'Confirmed'");
    }
};
