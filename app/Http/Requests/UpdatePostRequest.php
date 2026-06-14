<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 게시판 글 수정 처리 부분
            'title' => ['required', 'max:255', 'string'],
            'content' => ['required', 'string'],
            'is_secret' => ['nullable', 'boolean'],
        ];
    }

    /**
     * 에러 메시지 Attribute 이름 한글화
     */
    public function attributes(): array
    {
        return [
            'is_secret' => '비밀글',
        ];
    }
}
