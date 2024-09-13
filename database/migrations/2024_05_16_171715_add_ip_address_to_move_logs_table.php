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
        Schema::table('move_logs', function (Blueprint $table) {
            //
            $table->string('ip_address', 45)->comment('操作者IP')->after('user_id');
            $table->string('email')->comment('操作者Email')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('move_logs', function (Blueprint $table) {
            //
        });
    }
};
