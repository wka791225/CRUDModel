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
            $table->string('account_status')->default(0)->comment('帳號狀態')->after('user_id');
            $table->string('judge_status')->default(0)->comment('評審狀態')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('judges', function (Blueprint $table) {
            $table->dropColumn('account_status');
            $table->dropColumn('judge_status');
        });
    }
};
