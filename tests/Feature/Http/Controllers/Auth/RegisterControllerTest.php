<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;

class RegisterControllerTest extends TestCase
{
    use WithFaker;

    /**
     * Test for a GET /register
     */
    public function testReturnsRegisterView(): void {
        $this->get(route('register'))
             ->assertOk()
             ->assertViewIs('auth.register');
    }

    /**
     * Test for a POST /register
     */
    public function testUserRegistration(): void {
        // 테스트시 이메일 전송 안되게
        Event::fake();

        $email = $this->faker->safeEmail;

        // post 전달관련
        $this->post(route('register'), [
                'name' => $this->faker->name
                ,'email' => $email
                ,'password' => 'password'
            ])
            ->assertRedirect(
                route('index')
            );

        // Test to confirm DB
        $this->assertDatabaseHas('users', [
            'email' => $email
        ]);
    }

}
