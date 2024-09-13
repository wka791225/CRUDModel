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
        // 社群媒體管理(smms)
        Schema::create('smms', function (Blueprint $table) {
            $table->id();
            $table->string('live_stream_link')->comment('直播連結');
            $table->string('fb_link')->comment('FB連結');
            $table->string('ig_link')->comment('IG連結');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smms');
    }
};
