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
        // 학생계정 테이블
        if (!Schema::hasTable('student_accounts')) {
            Schema::create('student_accounts', function (Blueprint $table) {
                $table->string('oauth_id', 20)->primary()->comment('googleId');
                $table->string('student_pw', 20)->nullable();
                $table->string('student_id3', 7);
                $table->foreign('student_id3')->references('student_id')->on('students');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_accounts');
    }
};
