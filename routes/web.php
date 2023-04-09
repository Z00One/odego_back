<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Attendance\GetAttendance;

// DB 참석 테이블에 유저의 id로 값을 찾아보고 없으면 출석 버튼 동작하도록 하는 데이터 반환
// 있으면 이미 출석했다는 데이터 반환
Route::get('/', [GetAttendance::class, 'isAttend']); // GetAttendance 컨트롤러 isAttend메서드 호출

// 유저의 위치정보와 DB의 강의실 위치의 대조 미들웨어 만들어야 함
Route::post('/', function () {
    return response()->json($data = 'ok', 200);
});

Route::put('/', function () {
    return response()->json($data = '출석 완료', 200);
});