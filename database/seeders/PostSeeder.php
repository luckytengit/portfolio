<?php

namespace Database\Seeders;

use App\Models\Board\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 게시판 Post 파트
        User::all()->each(function (User $user) {
            Post::factory()->for($user)->create();
        });
    }
}
