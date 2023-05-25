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
        // 참석 테이블
        if (!Schema::hasTable('attendance')) {
            Schema::create('attendance', function (Blueprint $table) {
                $table->string('student_id', 7);
                $table->unsignedInteger('selfpaced_id');
                $table->timestamps();
                $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
                $table->foreign('selfpaced_id')->references('selfpaced_id')->on('selfpaced')->onDelete('cascade');
                $table->primary(['student_id', 'selfpaced_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
