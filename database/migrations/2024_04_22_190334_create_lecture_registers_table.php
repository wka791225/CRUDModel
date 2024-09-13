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
        Schema::create('lecture_registers', function (Blueprint $table) {
            $table->id();
            $table->string('join_lectures')->comment('場次');
            $table->string('name')->comment('姓名');
            $table->string('id_number')->comment('身份證字號');
            $table->date('birthday')->comment('出生年月日');
            $table->unsignedTinyInteger('type')->default(1)->comment('身分別(1: 學生, 2: 社會人士)');
            $table->string('phone')->comment('連絡電話');
            $table->string('email')->comment('連絡信箱');
            $table->string('hope')->default('')->comment('講座期許');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecture_registers');
    }
};
