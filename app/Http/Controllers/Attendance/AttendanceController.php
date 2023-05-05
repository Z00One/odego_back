<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{    
    // 최초 접속
    public function isAttend() // 출석 여부 확인
    {
        $user_id = 2201303;
        // 사용자의 출석 정보를 가져옴
        $attendance = Attendance::where('student_id', $user_id)->get();
        // 가져온 값이 비어있다면 false , 있다면 true 반환
        $attendance = $attendance->isEmpty() ? 'false' : 'true';

        // 사용자의 반 정보를 가져옴
        $classId = Student::where('student_id', $user_id)->get('class_id');

        // 사용자의 반의 위치(위도, 경도)를 가져옴
        $classRoomId = !$classId->isEmpty()
        // 반에 등록된 경우
        ? Classroom::where('class_id', $classId)->get('building_id')
        // 반에 등록되지 않은 경우
        : '아직 반이 없어요';

        return view('main.main', ['isAttendent' => $attendance, 'classRoomId' => $classRoomId, 'classId' => $classId]);
    }

    // 출석 가능한지 확인
    public function isAttendable(Request $request)
    {
        // 반올림할 포인트
        define('AUTHENTIC_POINT', 4);

        // 받아온 유저의 위도 경도 값
        $userLocation = $request->input('location');

        // 테스트 코드 -> 후에 DB에 강의실 위치를 조회하여 진행해야함
        $latitude = 35.9473;
        $longitude = 128.4636;
        
        // 위도나 경도 중에 하나만 틀려도 바로 반환되게 만드는게 좋을 듯
        
        // 강의실 위치, 사용자 위치 비교하기
        // 소수점 5번째 자리에서 반올림한 값이 같다면 출석 가능
        $isAuthenticLatitude = round($userLocation['latitude'], AUTHENTIC_POINT) == $latitude ? true : false;
        $isAuthenticLongitude = round($userLocation['longitude'], AUTHENTIC_POINT) == $longitude ? true : false;
        
        $isAuthenticLocate = ($isAuthenticLatitude && $isAuthenticLongitude) ? 'ok' : 'no';
        // 간단한 반환은 response 인스턴스 반환, 문자열은 메서드 체이닝을 통해 json으로 변환하여 반환
        return response()->json(['isAuthenticLocate' => $isAuthenticLocate]);
    }
}