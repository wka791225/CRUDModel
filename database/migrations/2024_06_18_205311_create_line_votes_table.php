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
        Schema::create('line_votes', function (Blueprint $table) {
            $table->id();
            $table->string('line_id')->constrained()->comment('lineId');
            $table->string('email')->comment('信箱');
            $table->string('name')->comment('姓名');
            $table->bigInteger('vote_work_id')->constrained()->comment('投票作品ID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_votes');
    }
};
