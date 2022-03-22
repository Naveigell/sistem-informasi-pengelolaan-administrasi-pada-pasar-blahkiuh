<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BiodataRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            "nama"    => "required|string|max:255",
            "email"   => "required|string|max:255",
            "no_telp" => "required|string|min:1|max:255",
            "alamat"  => "required|string|max:255",
        ];

        // if email input is different
        if (auth('web')->user()->email !== $this->get('email')) {
            $rules['email'] .= '|unique:users';
        }

        return $rules;
    }
}
