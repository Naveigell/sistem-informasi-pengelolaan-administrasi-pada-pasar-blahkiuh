<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TempatKategoriRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "nama_kategori" => "required|string|min:3|max:255",
            "keterangan"    => "required|string|min:3|max:255",
            "nominal"       => "required|integer|min:1",
        ];
    }
}
