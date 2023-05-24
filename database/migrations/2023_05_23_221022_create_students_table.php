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
        // 학생 테이블
        if (!Schema::hasTable('students')) {
            Schema::create('students', function (Blueprint $table) {
                $table->string('student_id', 7)->primary();
                $table->string('class_id', 10);
                $table->string('name', 10)->nullable();
                $table->string('contact', 16)->nullable();
                $table->foreign('class_id')->references('class_id')->on('class');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
