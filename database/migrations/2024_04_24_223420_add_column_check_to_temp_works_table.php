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
        Schema::table('temp_works', function (Blueprint $table) {
            //
            $table->boolean('check_personal')->default(0)->comment('是否審核 1:已審核 0:未審核')->after('personal_data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('temp_works', function (Blueprint $table) {
            //
        });
    }
};
