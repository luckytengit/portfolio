<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Portfolio\ExperienceController;

/**
 * 내경력 메뉴 관련 Route
 */

Route::resource('experience', ExperienceController::class);

