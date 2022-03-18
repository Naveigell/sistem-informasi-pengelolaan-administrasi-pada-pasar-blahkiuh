<?php

namespace App\Http\Requests\Admin;

use App\Models\JenisTagihan;
use App\Models\Pedagang;
use App\Models\Tempat;
use Illuminate\Foundation\Http\FormRequest;

class TagihanRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $merchants = Pedagang::query()->pluck('id')->join(',');
        $pedagang  = Pedagang::with('tempat.tempatKategori')->where('id', $this->get('pedagang_id'))->first();

        $tempatIds = $pedagang->tempat->tempatKategori->pluck('id')->join(',');

        return [
            "tempat_kategori_id" => "required|integer|in:{$tempatIds}",
            "pedagang_id"        => "required|integer|in:{$merchants}",
            "nominal"            => "required|integer|min:1|max:99999999",
        ];
    }

    protected function prepareForValidation()
    {
        $this->request->add([
            "nominal" => $this->get('nominal'),
        ]);
    }
}
