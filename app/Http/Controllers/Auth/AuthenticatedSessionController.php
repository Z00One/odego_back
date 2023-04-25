<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * AuthenticatedSessionController는 Laravel의 기본 인증 기능에서 로그인과 로그아웃에 관련된 로직을 처리하는 컨트롤러 클래스입니다. 이 컨트롤러 클래스는 Illuminate\Foundation\Auth\AuthenticatesUsers 트레이트를 사용하여 구현되어 있습니다.
 * AuthenticatedSessionController는 showLoginForm() 메서드를 포함하여, 로그인 화면을 보여주는 메서드와 attemptLogin() 메서드를 포함하여, 로그인 시도를 처리하는 메서드를 제공합니다. 또한, logout() 메서드를 포함하여 로그아웃을 처리하는 메서드도 제공합니다.
 * 이 컨트롤러 클래스는 미들웨어로 guest를 사용하여 로그인한 사용자가 로그인 페이지를 볼 수 없도록 합니다. 또한, 로그인 시도가 실패한 경우 로그인 페이지로 다시 이동하고, 로그인 성공 시 이전 페이지로 리디렉션합니다.
 * 이러한 AuthenticatedSessionController는 Laravel에서 제공하는 기본 인증 기능의 일부로써, 많은 Laravel 애플리케이션에서 로그인과 로그아웃에 관련된 로직을 처리하는데 사용됩니다. 필요에 따라 이 컨트롤러 클래스를 확장하여 로그인에 대한 추가적인 로직을 처리하거나 커스터마이징할 수 있습니다.
 */

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
