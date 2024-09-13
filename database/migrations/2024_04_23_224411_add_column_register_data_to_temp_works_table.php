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
            $table->text('register_data')->nullable()->comment('報名資料')->after('works_data');
            $table->text('personal_data')->nullable()->comment('報名個人資料')->after('works_data');
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
