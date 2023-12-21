<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KampusRequest extends FormRequest
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
        $id = (isset($this->kampus) ? $this->kampus->id : '');

        return [
            'thumbnail' => 'mimes:jpg,jpeg,png|max:2048',
            'nama' => 'unique:kampus,nama,'.$id
        ];
    }

    public function messages(): array
    {
        return [
            'thumbnail.mimes' => 'Format foto salah',
            'thumbnail.max' => 'Ukuran foto terlalu besar',
            'nama.unique' => 'Nama kampus sudah ada'
        ];
    }
}
