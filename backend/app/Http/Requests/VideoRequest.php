<?php

namespace App\Http\Requests;

use App\Enums\VideosStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class VideoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:10'],
            'description' => ['string'],
            'status' => [new Enum(VideosStatusEnum::class)],
            'image' => ['mimes:png,jpg'],
            'video_path' => ['mimes:mp4']
        ];
    }
}
