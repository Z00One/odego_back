<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; // DB 클래스 가져오기
use Illuminate\Http\Request;

class GetAttendance extends Controller
{
    // DB 조회 결과값, view return
    public function isAttend() // 출석 여부 확인
    {
        $userId = 2201303; // test data

        // attendence 테이블, student_id컬럼에서 $userId인 레코드 조회, 컬렉션 객체의 반환 여부에 따라 선택
        $attendance = DB::table('attendance')->where('student_id', $userId)->get() ? '출석 안한 상태' : '출석 한 상태';

        // classroom 테이블, building_id 이 유저의 class_id인 레코드 조회
        // classroom_id (강의실 장소 - 인제니움관 402호) -> 데이터 전달
        return view('main.main', ['isAttend' => $attendance]);
    }

    // request body의 사용자 위치 정보 (위도, 경도) 받아서
    // building_id (건물 위도, 경도) 와 비교한 값을 response에 담아 전달하는 컨트롤러
}
