<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LokasiRequest extends FormRequest
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
        $id = (isset($this->lokasi) ? $this->lokasi->id : '');

        return [
            'nama' => 'unique:lokasi,nama,'.$id
        ];
    }

    public function messages(): array
    {
        return [
            'nama.unique' => 'Nama lokasi sudah ada'
        ];
    }
}
