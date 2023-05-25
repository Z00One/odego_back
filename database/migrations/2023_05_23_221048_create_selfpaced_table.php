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
        // 자율학습 테이블
        if (!Schema::hasTable('selfpaced')) {
            Schema::create('selfpaced', function (Blueprint $table) {
                $table->unsignedInteger('selfpaced_id')->primary();
                $table->string('class_id', 10);
                $table->date('selfpaced_date')->nullable();
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
        Schema::dropIfExists('selfpaced');
    }
};
