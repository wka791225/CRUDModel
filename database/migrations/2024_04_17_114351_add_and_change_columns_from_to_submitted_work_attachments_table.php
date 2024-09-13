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
        Schema::table('submitted_work_attachments', function (Blueprint $table) {
            $table->string('filename')->comment('檔名')->after('type');
            $table->renameColumn('file_path', 'filepath');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submitted_work_attachments', function (Blueprint $table) {
            $table->dropColumn('filename');
            $table->renameColumn('filepath', 'file_path');
        });
    }
};
