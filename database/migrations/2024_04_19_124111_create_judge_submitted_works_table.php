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
        Schema::create('judge_submitted_works', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('judge_id');
            $table->unsignedBigInteger('submitted_work_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('judge_submitted_works');
    }
};
