<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KategoriRequest extends FormRequest
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
        $id = (isset($this->kategori) ? $this->kategori->id : '');

        return [
            'nama' => 'unique:kategori,nama,'.$id
        ];
    }

    public function messages(): array
    {
        return [
            'nama.unique' => 'Nama kategori sudah ada'
        ];
    }
}
