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
        Schema::create('judge_invited_records', function (Blueprint $table) {
            $table->id();

            $table->string('inviter_name')->comment('邀請者姓名');
            $table->longText('judge_invited_code')->comment('邀請識別碼');
            $table->boolean('status')->default(0)->comment('狀態(0: 未使用過, 1: 已使用過)');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('judge_invited_records');
    }
};
