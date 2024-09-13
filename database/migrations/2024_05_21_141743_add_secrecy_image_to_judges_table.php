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
        Schema::table('judges', function (Blueprint $table) {
            //
            $table->string('secrecy_image')->nullable()->comment('保密照片');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('judges', function (Blueprint $table) {
            //
        });
    }
};
