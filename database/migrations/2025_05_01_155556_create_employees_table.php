<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('employees', function (Blueprint $table) {
            $table->id(); // same as bigint(20) UNSIGNED NOT NULL
            $table->string('name');
            $table->string('email');
            $table->string('nic');
            $table->string('password');
            $table->string('position');
            $table->string('phone')->nullable();
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->string('city');
            $table->string('postal_code');
            $table->timestamps(); // adds created_at and updated_at as timestamps
        });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
