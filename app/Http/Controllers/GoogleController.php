<?php

namespace App\Http\Controllers;

use Socialite;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
      return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Could not authenticate with Google.'], 400);
            }
            return redirect('auth/google');
        }

        // Socialite user 객체에서 구글 ID 얻기
        $oauthId = $user->getId();

        // OAuth 계정 ID를 사용하여 User를 찾거나 생성
        $existingUser = StudentAccount::where('oauth_id', $oauthId)->first();
        if ($existingUser) {
            Auth::login($existingUser);
            if ($request->wantsJson()) {
                return response()->json(['redirect_url' => '/']);
            }
            return redirect('/');
        } else {
            // 유저가 없는 경우 회원가입 페이지로 리다이렉트
            if ($request->wantsJson()) {
                return response()->json([
                    'redirect_url' => '/register', 
                    'email' => $user->getEmail(), 
                    'name' => $user->getName(),
                    'oauth_id' => $oauthId
                ]);
            }

            return redirect('register')->with('email', $user->getEmail())->with('name', $user->getName())->with('oauth_id', $oauthId);
        }
    }
}
