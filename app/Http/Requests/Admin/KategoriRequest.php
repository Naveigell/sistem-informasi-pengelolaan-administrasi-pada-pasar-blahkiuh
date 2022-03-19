<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class KategoriRequest extends FormRequest
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
            "is_pedagang"   => "nullable",
        ];
    }

    protected function prepareForValidation()
    {
        if (!$this->get('is_pedagang')) {
            $this->request->add([
                "is_pedagang" => 0,
            ]);
        }
    }
}
