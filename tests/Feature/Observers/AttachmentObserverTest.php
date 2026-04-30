<?php

namespace Tests\Feature\Observers;

use App\Models\Attachment;
use App\Observers\AttachmentObserver;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AttachmentObserverTest extends TestCase
{
    /**
     * 글 삭제시 실 파일 삭제관련 Feature 테스트(Observer)
     */
    public function testDeletingUploadedFileForObserver(): void
    {
        $storage = Storage::fake('public');
        $file = UploadedFile::fake()->image('testFile.jpg');

        $file->store('/,public');

        $attachment = Attachment::factory()->state([
            'original_name' => $file->getClientOriginalName(),
            'name' => $file->hashName(),
        ])
        ->create();

        $observer = new AttachmentObserver();

        $observer->deleted($attachment);

        $storage->assertMissing($attachment->name);

    }
}
