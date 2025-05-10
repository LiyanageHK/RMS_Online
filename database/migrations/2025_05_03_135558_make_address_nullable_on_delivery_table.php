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
    Schema::table('delivery', function (Blueprint $table) {
        $table->unsignedBigInteger('driver_id');
        $table->string('address')->nullable()->change();

        $table->string('phone')->nullable()->default('')->change();
    });
}

public function down()
{
    Schema::table('delivery', function (Blueprint $table) {
        $table->dropColumn('driver_id');
        $table->string('address')->nullable(false)->change();
        $table->string('phone')->nullable(false)->default(null)->change();
    });
}

};
