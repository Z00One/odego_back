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
        // 공지사항 테이블
        if (!Schema::hasTable('notices')) {
            Schema::create('notices', function (Blueprint $table) {
                $table->unsignedBigInteger('notice_id')->autoIncrement();
                $table->string('notice_title', 20)->nullable();
                $table->string('notice_content', 200)->nullable();
                $table->date('notice_date')->nullable();
                $table->integer('professor_id');
                $table->string('class_id', 10);
                $table->timestamps();
                $table->foreign('professor_id')->references('professor_id')->on('professors');
                $table->foreign('class_id')->references('class_id')->on('class');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
