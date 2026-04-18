<?php

namespace Database\Seeders;

use App\Models\Attachment;
use App\Models\Experience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 회원당 1개 레코드 생성
        User::all()->each(function (User $user) {
            Experience::factory()->for($user)->create();
        });

        Experience::factory()->has(Attachment::factory());
    }
}
