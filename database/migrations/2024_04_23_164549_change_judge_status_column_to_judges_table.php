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
            $table->unsignedSmallInteger('judge_status')->default(1)->change();
            $table->unsignedSmallInteger('account_status')->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('judges', function (Blueprint $table) {
            $table->unsignedSmallInteger('judge_status')->default(0)->change();
            $table->unsignedSmallInteger('account_status')->default(0)->change();
        });
    }
};
