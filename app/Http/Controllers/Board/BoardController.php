<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use App\Models\Board\Board;

class BoardController extends Controller
{
    public function __construct() {
        // BoardPolicy 정책 적용
        $this->authorizeResource(Board::class, 'boards');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 게시판관리 - 메인 리스트단
        return view('board.index', [
            'boards' => Board::with('user')->latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 게시판관리 - 등록 폼단
        return view('board.write', [
            'board' => (object) [
                'id' => '',
                'name' => '',
                'display_name' => '',
            ],
            'formActionUrl' => route('boards.store'), // 등록 폼 Action url
            'nameReadonly' => '', // name inputbox readonly 적용
         ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBoardRequest $request)
    {
        $user = $request->user();

        $user->boards()->create(
            $request->validated()
        );

        return to_route("boards.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Board $board)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Board $board)
    {
        // 수정 폼단 로드(등록폼, 수정폼 공유)
        return view("board.write", [
            'board' => $board,
            'formActionUrl' => route('boards.update', $board), // 수정 폼 Action url
            'nameReadonly' => 'readonly', // name inputbox readonly 적용
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBoardRequest $request, Board $board)
    {
        // 수정 처리단
        $board->update(
            $request->validated()
        );

        return to_route("boards.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Board $board)
    {
        // 글 삭제
        $board->delete();

        return to_route('boards.index');
    }
}
