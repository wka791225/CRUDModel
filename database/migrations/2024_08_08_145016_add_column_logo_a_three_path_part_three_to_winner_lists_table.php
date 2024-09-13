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
        Schema::table('winner_lists', function (Blueprint $table) {
            //
            $table->string('logo_a_three_path_part_three')->nullable()->comment('作品圖片A3名稱第三部分');
            $table->string('logo_a_three_name_part_three')->nullable()->comment('作品圖片A3名稱第三部分');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('winner_lists', function (Blueprint $table) {
            //
        });
    }
};
