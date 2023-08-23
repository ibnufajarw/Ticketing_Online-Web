<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcaraRequest extends FormRequest
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
            'judul' => 'max:180',
            'thumbnail' => 'mimes:jpg,jpeg,png|max:2048',
            'foto_stage' => 'mimes:jpg,jpeg,png|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'judul.max' => 'Judul acara maksimal :max karakter',
            'thumbnail.mimes' => 'Format foto salah',
            'thumbnail.max' => 'Ukuran foto terlalu besar',
            'foto_stage.mimes' => 'Format foto salah',
            'foto_stage.max' => 'Ukuran foto terlalu besar'
        ];
    }
}
