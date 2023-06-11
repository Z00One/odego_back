<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\StudentAccount;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $existingStudent = Student::where('student_id', $request->student_id)->first();

        if ($existingStudent) {
            return redirect()->back()->withErrors(['student_id' => '학번이 이미 존재합니다.']);
        }

        $request->validate([
            'student_id' => 'required|min:7|max:7',
            'class_id' => 'required|max:10',
            'name' => 'required|max:10',
            'contact' => 'nullable|min:11|max:11',
            'oauth_id' => 'required',
            'student_pw' => 'required|min:8',
        ]);

        $student = new Student();
        $student->student_id = $request->student_id;
        $student->class_id = $request->class_id;
        $student->name = $request->name;
        $student->contact = $request->contact;
        $student->save();

        $studentAccount = new StudentAccount();
        $studentAccount->student_id3 = $request->student_id;
        $studentAccount->oauth_id = $request->oauth_id;
        $studentAccount->student_pw = bcrypt($request->student_pw);
        $studentAccount->save();

        return redirect('/')->with('success', '회원가입이 완료되었습니다.');
    }
}
