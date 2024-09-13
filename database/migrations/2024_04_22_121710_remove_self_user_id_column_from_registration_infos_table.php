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
        Schema::table('registration_infos', function (Blueprint $table) {
            $table->dropColumn('self_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registration_infos', function (Blueprint $table) {
            $table->bigInteger('self_user_id')->default(0)->comment('原本的自己的User_id')->after('user_id');
        });
    }
};
