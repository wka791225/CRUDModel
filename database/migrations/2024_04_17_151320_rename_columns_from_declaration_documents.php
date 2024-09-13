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
        Schema::table('declaration_documents', function (Blueprint $table) {
            $table->renameColumn('filename', 'file_name');
            $table->renameColumn('filepath', 'file_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('declaration_documents', function (Blueprint $table) {
            $table->renameColumn('file_name', 'filename');
            $table->renameColumn('file_path', 'filepath');
        });
    }
};
