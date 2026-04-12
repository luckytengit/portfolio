<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * 로그인 폼 로드
     */
    public function showLoginForm() {
        return view("auth.login");
    }

    /**
     * 로그인 서버단 처리
     */
    public function login(LoginRequest $request) {

        if (! auth()->attempt($request->validated(), $request->boolean('remember'))) {
            // 실패시 이전페이지로 에러 메시지 전달
            return back()->withErrors([
                'failed' => __('인증이 실패했습니다(비밀번호를 확인해 주십시오.)')
            ]);
        }

        // 세션 생성
        $request->session()->regenerate();

        return redirect()->intended(); // 이전 페이지로
    }

    /**
     * 로그아웃 서버단 처리
     */
    public function logout() {
        auth()->logout();

        // 세션 ID 재정의
        session()->invalidate();

        // CSRF 토틈 갱신
        session()->regenerateToken();

        return redirect()->route("index");

    }
}

