<?php

namespace Tests\Feature\Http\Controllers\Portfolio;

use App\Models\Experience;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExperienceControllerTest extends TestCase
{
    use WithFaker;

    /**
    * 글 등록시 파일 저장 부분 테스트
    */
    public function testCreateExperience() {
        Storage::fake('public');
        $attachment = UploadedFile::fake()->image('fileExp.jpg');

        $experience = Experience::factory()->create();

        $data = [
            'subject' => $this->faker->text(10),
            'content' => $this->faker->text,
        ];

        $this->actingAs($experience->user)
            ->post(route('experience.store'), [
                ...$data,
                'attachments' => [
                    $attachment,
                ],
            ])
            ->assertRedirect();

        $this->assertCount(1, $experience->user()->get());

        // DB 저장되었는가 체크
        $this->assertDatabaseHas('attachments', [
            'original_name' => $attachment->getClientOriginalName(),
            'name' => $attachment->hashName('attachments'),
        ]);

        // 실 스토리지에 저장되었는가 체크
        Storage::disk('public')->assertExists(
            $attachment->hashName('attachments')
        );
    }
}
