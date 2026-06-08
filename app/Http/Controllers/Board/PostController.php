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
                'title' => '',
                'content' => ''
            ],
            'editorPath' => '../../../',
            'formActionUrl' => route('boards.posts.store', $board), // 등록 폼 Action url
            'board' => $board, // 취소 버튼 url 관련
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, Board $board)
    {
        // 게시판 글 등록 처리
        $user = $request->user();

        $post = $user->posts()->make($request->validated());
        $board->posts()->save($post);

        return to_route("boards.posts.index", $board);

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // 게시판 글 상세보기 페이지
        return view('board.post.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // 게시판 글 수정 폼 (등록 폼 공유)
        return view('board.post.create', [
            'post' => $post,
            'editorPath' => '../../',
            'formActionUrl' => route('posts.update', $post), // 수정 폼 Action url
            'board' => $post->board, // 취소 버튼 url 관련
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
        $post->delete();

        return to_route("boards.posts.index", $post->board);
    }
}
