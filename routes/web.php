<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;

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

// 포트폴리오 사이트 메인
Route::get('/', [RegisterController::class, 'index'])
    ->name('index');


// 인증관련
require __DIR__ . "/auth.php";

