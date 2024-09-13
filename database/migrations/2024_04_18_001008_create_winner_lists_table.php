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
        Schema::create('winner_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('ranking')->default(0)->nullable()->comment('名次,1:金獎,2:銀獎,3:銅獎,4:優選,5:入圍');
            $table->string('title')->nullable()->comment('作品名稱');
            $table->string('author')->nullable()->comment('作者');
            $table->text('creative_concept')->nullable()->comment('創作理念');
            $table->string('logo_path')->nullable()->comment('作品圖片');
            $table->string('logo_name')->nullable()->comment('作品圖片名稱');
            $table->string('logo_a_three_path')->nullable()->comment('作品圖片A3');
            $table->string('logo_a_three_name')->nullable()->comment('作品圖片A3名稱');
            $table->string('logo_a_three_path_part_two')->nullable()->comment('作品圖片A3第二部分');
            $table->string('logo_a_three_name_part_two')->nullable()->comment('作品圖片A3名稱第二部分');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('winner_lists');
    }
};
