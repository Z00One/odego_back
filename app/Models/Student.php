<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'students';  // 테이블명 지정

    // TODO: 이 부분은 나중에 수정해야 함
    protected $fillable = [
        'student_id',
        'class_id',
        'name',
        'contact',
        'email'
    ];
}
