<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class GetAttendance extends Controller
{
    private $userId;
    private $userLocation;

    // 최초 접속
    public function isAttend() // 출석 여부 확인
    {
        // $this->userId = $userId; // Google Oauth response에 해당되는 값 
        $userId = 2201303;

        $Att = new Attendance($userId);
        $attendance = $Att->getAttendance();
        $classId = $Att->getClassid() ? '2WDJ' : '아직 정보가 없습니다';
        $classRoomId = $Att->getClassRoomId() ? '인제니움관 402호' : '아직 정보가 없습니다';

        // 출석 여부를 attendance의 값으로 처리하여 렌더링 할 수 있도록
        return view('main.main', ['isAttendent' => $attendance, 'classRoomId' => $classRoomId, 'classId' => $classId]);

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
