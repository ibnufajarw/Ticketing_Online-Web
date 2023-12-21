<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'unique:users,email',
            'password' => 'min:8|confirmed'
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Email sudah digunakan',
            'password.min' => 'Password minimal :min karakter',
            'password.confirmed' => 'Password tidak sama'
        ];
    }
}
