<?php

namespace App\Policies;

use App\Models\Board;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BoardPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // 리스트단 정책(슈퍼 관리자만 사용)
        return $user->email == config("app.appAdminEmail");
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Board $board): bool
    {
        // 상세보기단 정책
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // 등록 폼 화면단 및 등록 처리단 정책(슈퍼 관리자만 사용)
        return $user->email == config("app.appAdminEmail");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Board $board): bool
    {
        // 수정 폼 화면단 및 수정 처리단 정책(슈퍼 관리자만 사용)
        return $user->email == config("app.appAdminEmail");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Board $board): bool
    {
        // 삭제단 정책(슈퍼 관리자만 사용)
        return $user->email == config("app.appAdminEmail");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Board $board): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Board $board): bool
    {
        return false;
    }
}
