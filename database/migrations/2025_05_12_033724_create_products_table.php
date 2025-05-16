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
        Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('description')->nullable();
    $table->tinyInteger('status')->default(0);
    $table->string('price')->nullable();
    $table->string('small')->nullable();
    $table->string('medium')->nullable();
    $table->string('large')->nullable();
    $table->timestamps();
    $table->string('small_price')->nullable();
    $table->string('medium_price')->nullable();
    $table->string('large_price')->nullable();
    $table->string('category_id')->nullable();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
