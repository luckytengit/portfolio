<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 슈퍼 유저를 위한 정책(슈퍼 유저는 기존 권한 설정 제외)
        Gate::before(function($user, $ability) {
            if ($user->email == config("app.appAdminEmail")) {
                return true;
            }
        });
    }
}
