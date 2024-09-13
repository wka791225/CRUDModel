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
        Schema::table('lecture_registers', function (Blueprint $table) {
            //
            // 小孩數
            $table->integer('child_number')->default(0)->comment('小孩數')->after('phone');
            // 成人數
            $table->integer('adult_number')->default(1)->comment('成人數')->after('child_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lecture_registers', function (Blueprint $table) {
            //
        });
    }
};
