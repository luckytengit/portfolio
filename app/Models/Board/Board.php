<?php

namespace App\Models\Board;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    // 라우트키를 id에서 name으로.
    public function getRouteKeyName() {
        return 'name';
    }
}
