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
        Schema::create('email_verification_records', function (Blueprint $table) {
            $table->id();
            $table->string('email')->comment('信箱');
            $table->longText('email_verification_code')->comment('信箱驗證碼');
            $table->boolean('status')->default(0)->comment('狀態(0: 未使用過, 1: 已使用過)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_verification_records');
    }
};
