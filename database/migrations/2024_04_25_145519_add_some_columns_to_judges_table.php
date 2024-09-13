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
            $table->unsignedBigInteger('user_id')->default(0)->comment('代表人帳號ID')->change();
            $table->unsignedBigInteger('judge_invited_record_id')->default(0)->comment('邀請碼ID')->after('user_id');
            $table->string('name')->default('')->comment('姓名')->after('account_status');
            $table->string('email')->default('')->comment('信箱')->after('name');
            $table->string('phone')->default('')->comment('電話')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('judges', function (Blueprint $table) {
            $table->dropColumn('judge_invited_record_id');
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('phone');
        });
    }
};
