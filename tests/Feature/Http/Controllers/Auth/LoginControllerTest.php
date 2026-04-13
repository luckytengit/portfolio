<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginControllerTest extends TestCase
{
    use WithFaker;

    /**
     * Test for a GET /login
     */
    public function testReturnsLoginView(): void {
        $this->get(route('login'))
             ->assertOk()
             ->assertViewIs('auth.login');
    }

    /**
     * Test for a POST /login (success)
     */
    public function testLoginForVaildCredentials(): void {
        $user = User::factory()->create();

        $this->post(route('login'), [
                'email' => $user->email
                ,'password' => 'password'
            ])
            ->assertRedirect();

        $this->assertAuthenticated();
    }

    /**
     * Test for a POST /login (fail)
     */
    public function testLoginForInvaildCredentials(): void {
        $user = User::factory()->create();

        $this->post(route('login'), [
                'email' => $user->email
                ,'password' => $this->faker->password(8)
            ])
            ->assertRedirect()
            ->assertSessionHasErrors('failed');

        // 로그인되지 않았음을 검증
        $this->assertGuest();
    }

    /**
     * Test for a POST /logout
     */
    public function testLogout(): void {
        $user = User::factory()->create();

        $this->actingAs($user) // $user 를 인증 상태로
            ->post(route('logout'))
            ->assertRedirect(route('index'));

        // 게스트 사용자인지 검증
        $this->assertGuest();
    }

}
