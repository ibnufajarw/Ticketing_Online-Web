<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetodePembayaranRequest extends FormRequest
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
        $id = (isset($this->metode_pembayaran) ? $this->metode_pembayaran->id : '');

        return [
            'logo' => 'mimes:jpg,jpeg,png|max:2048',
            'nama' => 'unique:metode_pembayaran,nama,'.$id
        ];
    }

    public function messages(): array
    {
        return [
            'logo.mimes' => 'Format foto salah',
            'logo.max' => 'Ukuran foto terlalu besar',
            'nama.unique' => 'Nama Metode Pembayaran sudah ada'
        ];
    }
}
