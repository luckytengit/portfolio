<?php

namespace App\Models\Board;

use App\Models\User;
use App\Models\Board\Board;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
    ];

    // user는 Post와 1:N 관계
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Board는 Post와 1:N 관계
    public function board() {
        return $this->belongsTo(Board::class);
    }
}
