<?php

namespace App\Http\Requests\Admin;

use App\Models\Kategori;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed pedagang_id
 */
class PemasukanRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $categoryIds = Kategori::query()->pluck('id')->join(',');

        /** @var Kategori $kategori*/
        $kategori    = $this->route('kategori');

        $rules = [
            "kategori_id" => "required|integer|in:{$categoryIds}",
            "nominal"     => "required|integer|min:1|max:99999999",
            "keterangan"  => "required|string|min:2|max:255",
            "tgl"         => "required|date",
        ];

        if ($kategori->is_pedagang) {
            $rules['pedagang_id'] = 'required|integer|min:1';
        }

        return $rules;
    }
}
