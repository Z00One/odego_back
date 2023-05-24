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
        // 강의실 테이블
        if (!Schema::hasTable('classrooms')) {
            Schema::create('classrooms', function (Blueprint $table) {
                $table->integer('building_id')->unsigned();
                $table->string('classroom_id', 15);
                $table->string('class_id', 10);
                $table->foreign('class_id')->references('class_id')->on('class')->onDelete('cascade');
                $table->primary(['building_id', 'classroom_id']);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
