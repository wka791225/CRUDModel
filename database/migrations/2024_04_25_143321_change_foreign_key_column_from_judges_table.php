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
        Schema::table('judges', function (Blueprint $table) {
            // 删除外鍵約束
            $table->dropForeign(['user_id']);
            $table->unsignedBigInteger('user_id')->comment('代表人帳號ID')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('judges', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('代表人帳號ID')->change();
        });
    }
};
