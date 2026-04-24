<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Attachment;
use App\Models\Experience;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AttachmentControllerTest extends TestCase
{
    /**
     * 스토리지 파일 저장 부분 테스트
     */
    public function testCreateAttachmentForExperince(): void
    {
        Storage::fake('public');

        $attachment = UploadedFile::fake()->image('file.jpg');

        $experience = Experience::factory()->create();

        // 테스트
        $this->actingAs($experience->user)
             ->post(route('experience.attachments.store', $experience), [
                 'attachments' => [
                     $attachment,
                 ],
             ])
             ->assertSuccessful();

        $this->assertCount(1, $experience->attachments);

        // DB에 가지고 있는가 체크
        $this->assertDatabaseHas('attachments', [
            'original_name' => $attachment->getClientOriginalName(),
            'name' => $attachment->hashName('attachments'),
        ]);

        // 스토리지쪽에 파일이 존재하는가 체크
        Storage::disk('public')->assertExists(
            $attachment->hashName('attachments')
        );

    }

    /**
     * 스토리지 파일 삭제 파트 테스트
     */
    public function testDeleteAttachmentFromExperince() {
        Storage::fake('public');

        $attachmentFile = UploadedFile::fake()->image('file.jpg');


        $experience = Experience::factory()->has(
            Attachment::factory()->state([
                'original_name' => $attachmentFile->getClientOriginalName(),
                'name' => $attachmentFile->hashName('attachments')
            ])
        )
        ->create();

        foreach ($experience->attachments as $attachment) {
            $this->actingAs($experience->user)
                ->delete(route('attachments.destroy', $attachment))
                -> assertRedirect();

            $this->assertDatabaseMissing('attachments', [
                'id' => $attachment->id,
            ]);

        }

    }

}
