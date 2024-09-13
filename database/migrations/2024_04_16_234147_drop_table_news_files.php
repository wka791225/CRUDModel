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
        Schema::dropIfExists('news_files');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('news_files', function ($table) {
            $table->id();
            $table->foreignId('news_id')->constrained()->onDelete('cascade');
            $table->string('file_path')->comment('檔案路徑');
            $table->timestamps();
        });
    }
};
