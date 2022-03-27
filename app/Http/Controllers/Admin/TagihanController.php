<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagihanRequest;
use App\Models\JenisTagihan;
use App\Models\Pedagang;
use App\Models\Tagihan;
use App\Models\TagihanTempatKategori;
use App\Models\TempatKategori;
use Database\Seeders\TempatKategoriSeeder;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tagihans = Tagihan::with('pedagang', 'tempatKategori')->get();

        return view('admin.pages.tagihan.index', compact('tagihans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $pedagangs = Pedagang::with('tempat.tempatKategori')->get();

        return view('admin.pages.tagihan.form', compact('pedagangs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $pedagang = Pedagang::with('tempat.tempatKategori')->where('id', $request->get('pedagang_id'))->first();
        $ids      = $pedagang->tempat->tempatKategori->pluck('id');

        $filteredIds = [];

        foreach ($ids as $id) {

            if ($request->get('tempat_kategori_ids-' . $id)) {
                $filteredIds[] = $id;
            }
        }

        $nominal = TempatKategori::query()->whereIn('id', $filteredIds)->sum('nominal');
        $tagihan = new Tagihan([
            "pedagang_id" => $request->get('pedagang_id'),
            "nominal"     => $nominal,
        ]);
        $tagihan->save();

        $tagihanTempatKategori = [];

        foreach ($filteredIds as $filteredId) {
            $tagihanTempatKategori[] = [
                "tagihan_id"         => $tagihan->id,
                "tempat_kategori_id" => $filteredId,
                "created_at"         => now()->toDateTimeString(),
                "updated_at"         => now()->toDateTimeString(),
            ];
        }

        TagihanTempatKategori::query()->insert($tagihanTempatKategori);

        return redirect()->route('admin.tagihans.index')->with('success', 'Berhasil menambah data tagihan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tagihan $tagihan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Tagihan $tagihan)
    {
        $tagihan->load('pedagang.tempat');

        $pedagangs     = Pedagang::with('tempat.tempatKategori')->get();

        return view('admin.pages.tagihan.form', compact('tagihan', 'pedagangs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagihanRequest $request
     * @param Tagihan $tagihan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TagihanRequest $request, Tagihan $tagihan)
    {
        $tagihan->fill($request->validated());
        $tagihan->save();

        return redirect()->route('admin.tagihans.index')->with('success', 'Berhasil mengubah data tagihan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tagihan $tagihan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Tagihan $tagihan)
    {
        $tagihan->delete();

        return redirect()->route('admin.tagihans.index')->with('success', 'Berhasil menghapus data tagihan');
    }
}
