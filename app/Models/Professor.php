<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Professor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'professors';  // 테이블명 지정

    // TODO: 이 부분은 나중에 수정해야 함
    protected $fillable = [
        'professor_id',
        'professor_name',
        'class_id',
        'email',
    ];
}
