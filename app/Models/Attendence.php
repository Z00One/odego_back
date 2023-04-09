<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attendence extends Model
{
    use HasFactory;
    private $classid; // 반
    private $classRoomId; // 강의실 위도 경도
    private $attendance; // 출석 여부

    public function __construct($userId)
    {
        // student 테이블, student_id컬럼에서 $userId인 레코드 조회, class_id 가져오기
        $this->classid = DB::table('classroom')->where('building_id', $userId)->get('class_id');

        // classroom 테이블, building_id 이 유저의 class_id인 레코드 조회, classroom_id 가져오기
        $this->classRoomId = DB::table('classroom')->where('building_id', $userId)->get('classroom_id');
        
        // attendence 테이블, student_id컬럼에서 $userId인 레코드 조회, 컬렉션 객체의 반환 여부에 따라 선택
        $this->attendance = DB::table('attendance')->where('student_id', $userId)->get() ? '출석 안한 상태' : '출석 한 상태';
    }

    public function getClassid()
    {
        return $this->classid;
    }

    public function getClassRoomId()
    {
        return $this->classRoomId;
    }

    public function getAttendance()
    {
        return $this->attendance;
    }
}
