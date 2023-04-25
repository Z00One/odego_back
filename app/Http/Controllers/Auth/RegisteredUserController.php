<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

// 새로운 사용자 등록에 관련된 로직을 처리하는 컨트롤러 클래스입니다.
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $email = $request->input('email');

        if (strpos($email, '@g.yju.ac.kr') !== false) {
            // 학생 케이스
            $request->validate([
                'student_id' => ['required', 'string', 'max:7', 'unique:'.User::class],
                'class_id' => ['required', 'string', 'max:10'],
                'name' => ['string', 'max:10'],
                'contact' => ['string', 'max:16'],
                'email' => ['required', 'string', 'email', 'max:20'],
            ]);

            $user = Student::create([
                'student_id' => $request->student_id,
                'class_id' => $request->class_id,
                'name' => $request->name,
                'contact' => $request->contact,
                'email' => $request->email,
            ]);
        } else {
            // 교수 케이스
            // TODO: 테이블에 맞게 수정해야 함
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        }

        event(new Registered($user));   // Laravel의 이벤트를 발생시키는 코드로, 사용자 등록 완료 이벤트를 발생시킵니다.

        Auth::login($user); // 새로 생성된 사용자로 로그인을 처리합니다.

        /**
         * 리다이렉트를 수행합니다. 해당 메소드가 호출되는 경로에 따라 리다이렉트 대상이 다르게 설정될 수 있습니다. 
         * 예를 들어, 사용자 회원가입 페이지에서 호출하는 경우, RouteServiceProvider::HOME 대신에 로그인된 사용자 홈페이지나 다른 경로로 리다이렉트를 수행할 수 있습니다.
         * RouteServiceProvider::HOME은 Laravel 애플리케이션에서 정의된 상수로, 기본적으로는 '/'을 반환합니다. 이는 Laravel이 라우트 처리를 수행할 때, 
         * 루트 경로에 해당하는 URI를 처리하는 라우트를 의미합니다.
         * 개발자가 애플리케이션에서 홈페이지 경로를 다른 URI로 변경하고 싶다면, RouteServiceProvider 클래스에서 $HOME 상수의 값을 수정해주면 됩니다.
         */
        return redirect(RouteServiceProvider::HOME);
    }
}
