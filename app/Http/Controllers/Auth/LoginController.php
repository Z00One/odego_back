<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors('로그인 과정에서 오류가 발생했습니다.');
        }
        

        // 이메일을 이용하여 사용자를 조회합니다.
        if ((Str::contains($user->getEmail(), '@g.yju.ac.kr') && Student::where('email', $user->getEmail())->first())) {
            // 이미 회원가입된 사용자일 경우 로그인 페이지로 이동합니다. -> 학생
            auth()->login($existingUser);
            return redirect('/home');
        } else if (Str::contains($user->getEmail(), '@gmail.com') && Professor::where('email', $user->getEmail())->first()) {  // TODO: 교수인 경우 email 수정
            // 이미 회원가입된 사용자일 경우 로그인 페이지로 이동합니다. -> 교수
            auth()->login($existingUser);
            return redirect('/home');   // TODO: 관리자 페이지로 이동
        } else if (Str::contains($user->getEmail(), '@g.yju.ac.kr') || Professor::where('email', $user->getEmail())->first()) {
            // 회원가입 페이지로 이동합니다.
            return redirect()->route('register', [
                'name' => $user->getName(),
                'email' => $user->getEmail(),
            ]);
        } else {    // 잘못된 이메일인 경우
            return redirect()->route('login')->withErrors('학교 이메일로만 로그인이 가능합니다.');
        }
        

    }   
}
