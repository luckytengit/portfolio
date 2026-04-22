<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Experience;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('attachments', function (Blueprint $table) {
            // 1. 기존 외래 키 제약 조건을 삭제합니다.
            $table->dropForeign(['experience_id']);

            // 2. 포레인키만 바꿈
            // foreign('컬럼명')->references('참조컬럼')->on('참조테이블')
            $table->foreign('experience_id')
                ->references('id')
                ->on('experiences') // Experience 모델의 테이블명 (보통 복수형)
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 되돌릴 때는 다시 cascade를 지우고 nullOnDelete를 설정합니다.
        Schema::table('attachments', function (Blueprint $table) {
            $table->dropForeign(['experience_id']);

            // 포레인키 이전 상태(nullOnDelete)로 복구
            $table->foreign('experience_id')
                ->references('id')
                ->on('experiences')
                ->nullOnDelete();
        });
    }
};
