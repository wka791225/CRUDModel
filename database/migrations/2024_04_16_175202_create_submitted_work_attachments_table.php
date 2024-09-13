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
        Schema::create('submitted_work_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submitted_work_id')->constrained('submitted_works')->onDelete('cascade')->comment('(已送出)參賽作品 ID');
            $table->unsignedTinyInteger('type')->comment('附件種類(1: 無說明文字之LOGO圖(logo), 2: 作品海報書名海報-1.jpg(work_1), 3: 作品海報書名海報-2.jpg(work_2), 4: 作品可編輯原檔.ai, .eps(work_edit), 5: 作品可攜式文件格式.pdf(work_pdf))');
            $table->string('file_path')->comment('檔案路徑');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submitted_work_attachments');
    }
};
