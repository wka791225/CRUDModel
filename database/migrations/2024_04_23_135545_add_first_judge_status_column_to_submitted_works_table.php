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
        Schema::table('submitted_works', function (Blueprint $table) {
            $table->string('judge_status')->default(0)->comment('評審狀態')->after('votes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submitted_works', function (Blueprint $table) {
            $table->dropColumn('judge_status');
        });
    }
};
