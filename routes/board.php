<?php

use App\Http\Controllers\Board\BoardController;
use Illuminate\Support\Facades\Route;


/**
 * 게시판관리 관련 Route
 */
Route::resource('boards', BoardController::class);

