<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/login/google', [AuthenticatedSessionController::class, 'create'])
        ->middleware('guest')
        ->name('login');

/**
 * /register URL로 GET 요청이 들어오면 RegisteredUserController의 create() 메서드가 실행됩니다. 이 메서드에서는 회원가입 페이지를 반환하게 됩니다. 
 * middleware('guest')는 해당 라우트에 접근하는 사용자가 로그인되어 있지 않은 경우에만 접근할 수 있도록 합니다. name('register')는 이 라우트의 이름을 register로 설정합니다.
 * 이렇게 register 라우트가 정의되어 있어야, AuthenticatedSessionController의 handleGoogleCallback 메서드에서 redirect()->route('register')을 사용하여 회원가입 페이지로 이동할 수 있습니다.
 */
Route::get('/register', [RegisteredUserController::class, 'create'])
        ->middleware('guest')
        ->name('register');