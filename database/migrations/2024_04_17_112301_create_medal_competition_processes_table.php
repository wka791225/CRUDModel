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
        Schema::create('medal_competition_processes', function (Blueprint $table) {
            $table->id();
            $table->string('step')->comment('步驟');
            $table->string('title')->comment('標題');
            $table->text('content')->comment('內文');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medal_competition_processes');
    }
};
