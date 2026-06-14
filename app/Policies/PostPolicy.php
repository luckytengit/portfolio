<?php

namespace App\Policies;

use App\Models\Board\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        // 메인 리스트
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Post $post): Response|bool
    {
        // 상세보기
        if (
            ( $post->is_secret == true && $user && $user->id == $post->user_id )  // 비밀글인 경우 글쓴 사용자만 볼 수 있게.
            || $post->is_secret == false // 비밀글이 아닌 경우는 누구나 볼 수 있게.
        ) {
            return true;
        }

        return Response::deny('권한이 없습니다(비밀글은 자신의 글만 볼 수 있습니다)');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // 등록 폼단 & 등록 처리단
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): Response|bool
    {
        // 수정 폼단 & 수정 처리단
        if ($user->id == $post->user_id ) {  // 글쓴 사용자만 수정 가능.
            return true;
        }

        return Response::deny('권한이 없습니다(자신의 글만 수정할 수 있습니다)');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): Response|bool
    {
        // 삭제단
        if ($user->id == $post->user_id ) {  // 글쓴 사용자만 삭제 가능.
            return true;
        }

        return Response::deny('권한이 없습니다(자신의 글만 삭제할 수 있습니다)');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        //
    }
}
