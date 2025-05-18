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
        Schema::create('user_per', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('role');
            $table->timestamp('created_at')->useCurrent();

            // Permissions (default 0 = false)
            $table->boolean('inv')->default(0);
            $table->boolean('cus')->default(0);
            $table->boolean('order')->default(0);
            $table->boolean('deli')->default(0);
            $table->boolean('emp')->default(0);
            $table->boolean('acc')->default(0);
            $table->boolean('pro')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_per');
    }
};
