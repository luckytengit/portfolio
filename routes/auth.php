<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;



// 비로그인시
Route::middleware('guest')->group(function() {
    // 회원가입 폼 로드
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])
        ->name('register');

    // 회원가입 처리
    Route::post('register', [RegisterController::class, 'register']);
});


