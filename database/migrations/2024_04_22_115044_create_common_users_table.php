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
        Schema::create('common_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('代表人帳號ID');
            $table->string('id_number')->comment('身份證字號');
            $table->date('birthday')->comment('出生年月日');
            $table->unsignedTinyInteger('type')->default(1)->comment('身分別(1: 學生, 2: 社會人士)');
            $table->string('phone')->default('')->comment('連絡電話');
            $table->string('city')->default('')->comment('縣市');
            $table->string('address')->default('')->comment('通訊住址');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_users');
    }
};
