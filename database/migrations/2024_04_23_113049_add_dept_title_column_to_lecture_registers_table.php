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
            $table->string('dept_title')->default('')->comment('單位/職稱')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lecture_registers', function (Blueprint $table) {
            $table->dropColumn('dept_title');
        });
    }
};
