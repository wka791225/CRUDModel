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
        Schema::create('judges', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('代表人帳號ID');
            $table->string('id_number')->comment('身份證字號');
            $table->string('bank_account')->default('')->comment('核銷帳戶');
            $table->string('agreement_path')->default('')->comment('評審委員受聘同意書與簽名 路徑');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('judges');
    }
};
