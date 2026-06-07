<?php

use App\Http\Controllers\Board\BoardController;
use App\Http\Controllers\Board\PostController;
use Illuminate\Support\Facades\Route;

/**
 * 게시판 관련 Route
 */


/**
 * 게시판관리 부분 관련
 */
Route::resource('boards', BoardController::class);

/**
 * 게시판 글 관련
 */
Route::resource('boards.posts', PostController::class)
    ->shallow();
