<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 반 테이블
        if (!Schema::hasTable('class')) {
            Schema::create('class', function (Blueprint $table) {
                $table->string('class_id', 10)->default('-1')->primary()->comment('초기값: -1');
                $table->integer('persons')->nullable();
            });
        }

        // 학생 테이블
        if (!Schema::hasTable('student')) {
            Schema::create('student', function (Blueprint $table) {
                $table->string('student_id', 7)->primary();
                $table->string('class_id', 10);
                $table->string('name', 10)->nullable();
                $table->string('contact', 16)->nullable();
                $table->foreign('class_id')->references('class_id')->on('class');
            });
        }

        // 교수 테이블
        if (!Schema::hasTable('professor')) {
            Schema::create('professor', function (Blueprint $table) {
                $table->integer('professor_id')->primary();
                $table->string('professor_name', 5)->nullable();
                $table->string('class_id', 10);
                $table->foreign('class_id')->references('class_id')->on('class');
            });
        }

        // 사유서 테이블
        if (!Schema::hasTable('reason')) {
            Schema::create('reason', function (Blueprint $table) {
                $table->integer('reason_id')->primary();
                $table->string('reason_title', 20)->nullable();
                $table->string('reason_content', 200)->nullable();
                $table->date('reason_date')->nullable();
                $table->string('student_id', 7);
                $table->boolean('authorized')->nullable()->default(null);
                $table->string('class_id', 10);
                $table->foreign('student_id')->references('student_id')->on('student');
            });
        }
        // 자율학습 테이블
        if (!Schema::hasTable('selfpaced')) {
            Schema::create('selfpaced', function (Blueprint $table) {
                $table->integer('selfpaced_id')->primary();
                $table->string('class_id', 10);
                $table->date('selfpaced_date')->nullable();
                $table->foreign('class_id')->references('class_id')->on('class');
            });
        }

        // 학생계정 테이블
        if (!Schema::hasTable('student_account')) {
            Schema::create('student_account', function (Blueprint $table) {
                $table->string('oauth_id', 20)->primary()->comment('googleId');
                $table->string('student_pw', 20)->nullable();
                $table->string('student_id3', 7);
                $table->foreign('student_id3')->references('student_id')->on('student');
            });
        }
        // 교수계정 테이블
        if (!Schema::hasTable('professor_account')) {
            Schema::create('professor_account', function (Blueprint $table) {
                $table->string('pro_id', 20)->primary();
                $table->string('pro_pw', 20)->nullable();
                $table->integer('professor_id2');
                $table->string('pro_mail', 30)->nullable();
                $table->foreign('professor_id2')->references('professor_id')->on('professor');
            });
        }

        // 공지사항 테이블
        if (!Schema::hasTable('notice')) {
            Schema::create('notice', function (Blueprint $table) {
                $table->integer('notice_id')->primary();
                $table->string('notice_title', 20)->nullable();
                $table->string('notice_content', 200)->nullable();
                $table->date('notice_date')->nullable();
                $table->integer('professor_id');
                $table->string('class_id', 10);
                $table->foreign('professor_id')->references('professor_id')->on('professor');
                $table->foreign('class_id')->references('class_id')->on('class');
            });
        }

        // 강의실 테이블
        if (!Schema::hasTable('classroom')) {
            Schema::create('classroom', function (Blueprint $table) {
                $table->integer('building_id')->unsigned();
                $table->string('classroom_id', 15);
                $table->string('class_id', 10);
                $table->foreign('class_id')->references('class_id')->on('class')->onDelete('cascade');
                $table->primary(['building_id', 'classroom_id']);
            });
        }

        // 가입신청 테이블
        if (!Schema::hasTable('sign_up')) {
            Schema::create('sign_up', function (Blueprint $table) {
                $table->string('student_id', 7);
                $table->string('name', 10)->nullable();
                $table->string('contact', 16)->nullable();
                $table->string('class_id', 10)->nullable();
                $table->foreign('class_id')->references('class_id')->on('class')->onDelete('cascade');
                $table->primary(['student_id', 'class_id']);
            });
        }

        // 공지사항_읽음여부 테이블
        if (!Schema::hasTable('notice_read')) {
            Schema::create('notice_read', function (Blueprint $table) {
                $table->integer('notice_id')->unsigned();
                $table->string('student_id', 7);
                $table->foreign('notice_id')->references('notice_id')->on('notice')->onDelete('cascade');
                $table->foreign('student_id')->references('student_id')->on('student')->onDelete('cascade');
                $table->primary(['notice_id', 'student_id']);
            });
        }

        // 참석 테이블
        if (!Schema::hasTable('attendance')) {
            Schema::create('attendance', function (Blueprint $table) {
                $table->string('student_id', 7);
                $table->integer('selfpaced_id')->unsigned();
                $table->foreign('student_id')->references('student_id')->on('student')->onDelete('cascade');
                $table->foreign('selfpaced_id')->references('selfpaced_id')->on('selfpaced')->onDelete('cascade');
                $table->primary(['student_id', 'selfpaced_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reason');
        Schema::dropIfExists('student_account');
        Schema::dropIfExists('professor_account');
        Schema::dropIfExists('classroom');
        Schema::dropIfExists('sign_up');
        Schema::dropIfExists('notice_read');
        Schema::dropIfExists('notice');
        Schema::dropIfExists('attendance');
        Schema::dropIfExists('sign_up');
        Schema::dropIfExists('classroom');
        Schema::dropIfExists('selfpaced');
        Schema::dropIfExists('professor');
        Schema::dropIfExists('student');
        Schema::dropIfExists('class');
    }
};