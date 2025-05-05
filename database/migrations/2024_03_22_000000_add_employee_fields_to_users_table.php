<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('employee_id')->unique()->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->date('join_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'address',
                'employee_id',
                'department',
                'position',
                'join_date'
            ]);
        });
    }
}; 