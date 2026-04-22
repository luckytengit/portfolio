<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            // 필드 삭제
            $table->dropColumn(['filepath', 'filename_origin', 'filename']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            // 파일관련 필드
            $table->string('filepath')->nullable();;
            $table->string('filename_origin')->nullable();;
            $table->string('filename')->nullable();;
        });
    }
};
