<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Attachment;

class Experience extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'subject',
        'content',
    ];

    /**
     *  회원 테이블과의 관계
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     *  파일 첨부 테이블과의 관계
     */
    public function attachments() {
        return $this->hasMany(Attachment::class);
    }
}
