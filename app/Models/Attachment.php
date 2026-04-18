<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Experience;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'original_name',
        'name',
    ];

    /**
     * 경력 테이블과의 관계
     */
    public function experience() {
        return $this->belongsTo(Experience::class);
    }

    /**
     * name 값이 http(s)로 시작하는지를 반환
     */
    public function external(): Attribute {
        return Attribute::make (
            get: fn() => preg_match('/^https?/', $this->name),
        );
    }

    /**
     *
     */
    public function link(): Attribute {
        return Attribute::make (
            get: function($value) {
                $path = $this->external
                    ? $this->name
                    : Storage::disk('public')->url($this->name);

                return $value ?? $path;
            },
            set: fn($value) => $value,
        );
    }

}
