<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Portfolio\ExperienceController;
use App\Http\Controllers\AttachmentController;

/**
 * 내경력 메뉴 관련 Route
 */
Route::resource('experience', ExperienceController::class);


/**
 * 파일 첨부
 */
Route::resource('experience.attachments', AttachmentController::class)
    ->shallow()
    ->only(['store', 'destroy']);

