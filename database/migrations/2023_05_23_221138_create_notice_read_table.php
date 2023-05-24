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
        // 공지사항_읽음여부 테이블
        if (!Schema::hasTable('notice_read')) {
            Schema::create('notice_read', function (Blueprint $table) {
                $table->unsignedBigInteger('notice_id');
                $table->string('student_id', 7);
                $table->timestamps();
                $table->foreign('notice_id')->references('notice_id')->on('notices')->onDelete('cascade');
                $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
                $table->primary(['notice_id', 'student_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notice_read');
    }
};
