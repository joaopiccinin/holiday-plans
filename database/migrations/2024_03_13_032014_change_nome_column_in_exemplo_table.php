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
        Schema::table('holiday_plans', function (Blueprint $table) {
            $table->text('participants')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('holiday_plans', function (Blueprint $table) {
            $table->integer('participants')->nullable()->change();
        });
    }
};
