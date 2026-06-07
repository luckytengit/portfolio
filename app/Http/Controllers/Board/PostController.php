<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Board\Board;
use App\Models\Board\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Board $board)
    {
        // 게시판 글 목록
        return view('board.post.index', [
            'posts' => $board->posts()->latest()->paginate(10),
            'board' => $board,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Board $board)
    {
        // 게시판 글 등록 폼
        return view('board.post.create', [
            'post' => (Object) [
                'id' => '',
                'board_id' => $board->id,
                'title' => '',
                'content' => ''
            ],
            'editorPath' => '../../../',
            'formActionUrl' => route('boards.posts.store', $board), // 등록 폼 Action url
            'board' => $board,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // 게시판 글 등록 처리
        $user = $request->user();

        $user->posts()->create(
            $request->validated(),
        );

        return to_route("boards.posts.index", $request->board);

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Board 객체 추출
        $boardArr = $post->board()->get();
        $board = $boardArr[0];

        // 유저 정보 추출
        $userArr = $post->user()->get();
        $user = $userArr[0];

        // 게시판 글 상세보기 페이지
        return view('board.post.show', [
            'post' => $post,
            'board' => $board,
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

        // Board 객체 추출
        $boardArr = $post->board()->get();
        $board = $boardArr[0];

        // 게시판 글 수정 폼 (등록 폼 공유)
        return view('board.post.create', [
            'post' => $post,
            'editorPath' => '../../',
            'formActionUrl' => route('posts.update', $post), // 수정 폼 Action url
            'board' => $board,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update(
            $request->validated(),
        );

        return to_route("posts.show", $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Board 객체 추출
        $boardArr = $post->board()->get();
        $board = $boardArr[0];

        $post->delete();

        return to_route("boards.posts.index", $board);
    }
}
