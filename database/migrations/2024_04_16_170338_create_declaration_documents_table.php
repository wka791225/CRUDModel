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
        Schema::create('declaration_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_info_id')->constrained('registration_infos')->onDelete('cascade')->comment('報名資訊 ID');
            $table->unsignedTinyInteger('type')->comment('附件種類(1: 身分證影本(代表人), 2: 參賽同意書, 3: 著作授權書, 4: 智慧財產權無條件讓與證明書, 5: 團體成員名單與授權同意書)');
            $table->string('file_path')->comment('檔案路徑');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declaration_documents');
    }
};
