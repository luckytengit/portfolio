<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Board;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BoardControllerTest extends TestCase
{
    use WithFaker;

    /**
     * 게시판관리 메인 리스트단 테스트
     */
    public function testReturnIndexViewForBoard(): void {
        $user = User::factory()->create();

        // For Policy
        $user['email'] = config("app.appAdminEmail");

        $this->actingAs($user)
            ->get(route('boards.index'))
            ->assertok()
            ->assertViewIs('board.index');
    }

    /**
     * 게시판관리 등록 폼단 테스트
     */
    public function testReturnCreateViewBoard(): void {
        $user = User::factory()->create();

        $user['email'] = config("app.appAdminEmail");

        $this->actingAs($user)
            ->get(route('boards.create'))
            ->assertok()
            ->assertViewIs('board.write');
    }

    /**
     * 게시판관리 등록 처리단 테스트
     */
    public function testStoreBoard(): void {
        // $user = User::factory()->create();
        $board = Board::factory()->create();

        // For Policy
        $userRw = User::where('email', config("app.appAdminEmail"))->get();
        $board['user_id'] = $userRw[0]['id'];

        $data = [
            'name' => $this->faker->unique()->word(),
            'display_name' => $this->faker->name,
        ];

        $this->actingAs($board->user)
            // DB 라우트 처리
            ->post(route('boards.store', $board), $data)
            ->assertRedirect();

        // DB 저장되었는가 체크
        $this->assertDatabaseHas('boards', $data);
    }

    /**
     * 게시판관리 수정 폼단 테스트
     */
    public function testReturnEditViewBoard(): void {
        $board = Board::factory()->create();

        // For Policy
        $userRw = User::where('email', config("app.appAdminEmail"))->get();
        $board['user_id'] = $userRw[0]['id'];

        $this->actingAs($board->user)
            ->get(route('boards.edit', $board))
            ->assertok()
            ->assertViewIs('board.write');
    }

    /**
     * 게시판관리 수정 처리단 테스트
     */
    public function testUpdateBoard(): void {
        $board = Board::factory()->create();

        // For Policy
        $userRw = User::where('email', config("app.appAdminEmail"))->get();
        $board['user_id'] = $userRw[0]['id'];

        $data = [
            'name' => $this->faker->words(3, true),
            'display_name' => $this->faker->name,
        ];

        $this->actingAs($board->user)
            // DB 라우트 처리
            ->put(route('boards.update', $board), $data)
            ->assertRedirect();

        // DB 저장되었는가 체크
        $this->assertDatabaseHas('boards', $data);
    }

    /**
     * 게시판관리 삭제 처리단 테스트
     */
    public function testDestroyBoard(): void {
        $board = Board::factory()->create();

        // For Policy
        $userRw = User::where('email', config("app.appAdminEmail"))->get();
        $board['user_id'] = $userRw[0]['id'];

        $this->actingAs($board->user)
            // DB 라우트 처리
            ->put(route('boards.destroy', $board))
            ->assertRedirect();
    }

}
