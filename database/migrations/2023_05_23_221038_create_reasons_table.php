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
        // 사유서 테이블
        if (!Schema::hasTable('reasons')) {
            Schema::create('reasons', function (Blueprint $table) {
                $table->integer('reason_id')->primary();
                $table->string('reason_title', 20)->nullable();
                $table->string('reason_content', 200)->nullable();
                $table->date('reason_date')->nullable();
                $table->string('student_id', 7);
                $table->boolean('authorized')->nullable()->default(null);
                $table->string('class_id', 10);
                $table->foreign('student_id')->references('student_id')->on('students');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reasons');
    }
};
