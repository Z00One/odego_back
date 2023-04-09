<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; // DB 클래스 가져오기
use app\Models\Attendence;
use Illuminate\Http\Request;

class GetAttendance extends Controller
{
    private $userId;
    private $userLocation;
    private $classId; // 반
    private $classRoomId; // 강의실 위도 경도
    private $attendance; // 출석 여부

    // 최초 접속
    public function isAttend() // 출석 여부 확인
    {
        // $this->userId = $userId; // Google Oauth response에 해당되는 값 
        $userId = 2201303;

        // $Att = new Attendence($userId);
        // $this->classId = $Att->getClassid();
        // $this->classRoomId = $Att->getClassRoomId();
        // $this->attendance = $Att->getAttendance();
        $attendance = DB::table('attendance')->where('student_id', $userId)->get() ? '출석 안한 상태' : '출석 한 상태';

        // 출석 여부를 attendance의 값으로 처리하여 렌더링 할 수 있도록
        return view('main.main', ['isAttend' => $attendance]);
    }

    // 출석 요청
    public function attend($userLocation)
    {
        // 받아온 유저의 위도 경도 값
        $this->userLocation = $userLocation;

        // Attendance 모델에서 classid, classRoomId 값 가져오기

        // 강의실 위치, 사용자 위치 비교하기

    }

    // request body의 사용자 위치 정보 (위도, 경도) 받아서
    // building_id (건물 위도, 경도) 와 비교한 값을 response에 담아 전달하는 컨트롤러
}
