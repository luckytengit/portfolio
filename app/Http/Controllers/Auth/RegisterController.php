<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class RegisterController extends Controller
{
    // 포트폴리오 사이트 메인
    public function index() {
        return view('index');
    }

    // 회원가입 폼 뷰단
    public function showRegistrationForm() {
        return view('auth.register');
    }

    // 회원가입 DB 처리
    public function register(Request $request) {

        $request->validate([
            'name' => 'required|max:255'
            ,'email' => 'required|email|unique:users|max:255'
            ,'password' => 'required|max:255'
        ]);

        // POST
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        // Insert DB
        $user = User::create([
            'name' => $name
            ,'email' => $email
            ,'password' => Hash::make($password)
        ]);

        // 이동
        return redirect()->route('index');
    }

}
