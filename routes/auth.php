<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;



// 비로그인 경우
Route::middleware('guest')->group(function() {
    // 회원가입 폼 로드
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
        ->name('register');

    // 회원가입 서버단 처리
    Route::post('/register', [RegisterController::class, 'register']);


    // 로그인 폼 로드
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    // 로그인 서버단 처리
    Route::post('/login', [LoginController::class, 'login']);

});

// 로그인 경우
Route::middleware('auth')->group(function() {
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});



