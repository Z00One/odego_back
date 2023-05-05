<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';

    protected $fillable = [
        'student_id',  // 학번
        'selfpaced_id' // 야자학습id
    ];

    // student 테이블과 역관계
    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id', 'student_id');
    }
    
    // selfpaced 테이블과 역관계
    public function selfpaced()
    {
        return $this->belongsTo('App\Models\Selfpaced', 'selfpaced_id', 'selfpaced_id');
    }
}