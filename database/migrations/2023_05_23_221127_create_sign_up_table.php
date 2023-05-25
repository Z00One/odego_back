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
        // 가입신청 테이블
        if (!Schema::hasTable('sign_up')) {
            Schema::create('sign_up', function (Blueprint $table) {
                $table->string('student_id', 7);
                $table->string('name', 10)->nullable();
                $table->string('contact', 16)->nullable();
                $table->string('class_id', 10)->nullable();
                $table->timestamps();
                $table->foreign('class_id')->references('class_id')->on('class')->onDelete('cascade');
                $table->primary(['student_id', 'class_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sign_up');
    }
};
