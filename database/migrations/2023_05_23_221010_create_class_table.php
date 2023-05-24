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
        // 반 테이블
        if (!Schema::hasTable('class')) {
            Schema::create('class', function (Blueprint $table) {
                $table->string('class_id', 10)->default('-1')->primary()->comment('초기값: -1');
                $table->integer('persons')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class');
    }
};
