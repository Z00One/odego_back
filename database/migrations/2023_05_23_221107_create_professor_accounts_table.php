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
        // 교수계정 테이블
        if (!Schema::hasTable('professor_accounts')) {
            Schema::create('professor_accounts', function (Blueprint $table) {
                $table->string('pro_id', 20)->primary();
                $table->string('pro_pw', 20)->nullable();
                $table->integer('professor_id2');
                $table->string('pro_mail', 30)->nullable();
                $table->foreign('professor_id2')->references('professor_id')->on('professors');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professor_accounts');
    }
};
