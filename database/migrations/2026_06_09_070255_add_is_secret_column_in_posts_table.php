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
        Schema::table('posts', function (Blueprint $table) {
            // posts 테이블에 is_secret 필드 추가 - 기본값은 false
            $table->boolean('is_secret')->default(false)->comment('비밀글 유무');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // 롤백
			$table->dropColumn('is_secret');
        });
    }
};
