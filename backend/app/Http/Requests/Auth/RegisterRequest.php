<?php

namespace App\Http\Requests\Auth;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'role' => new Enum(UserRoleEnum::class),
            'name' => ['required', 'min:3', 'string'],
            'surname' => ['required', 'min:5', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', Password::min(6)->numbers()],
            'image' => ['mimes:png,jpg']
        ];
    }
}
