<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TempatKategoriRequest;
use App\Models\Tempat;
use App\Models\TempatKategori;
use Illuminate\Http\Request;

class TempatKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Tempat $tempat
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Tempat $tempat)
    {
        $categories = TempatKategori::query()->where('tempat_id', $tempat->id)->get();

        return view('admin.pages.tempat.kategori.index', compact('tempat', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Tempat $tempat
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Tempat $tempat)
    {
        return view('admin.pages.tempat.kategori.form', compact('tempat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TempatKategoriRequest $request
     * @param Tempat $tempat
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TempatKategoriRequest $request, Tempat $tempat)
    {
        $kategori = new TempatKategori(
            array_merge(
                $request->validated(), ["tempat_id" => $tempat->id]
            )
        );
        $kategori->save();

        return redirect(route('admin.tempats.kategori.index', $tempat));
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
     * @param Tempat $tempat
     * @param TempatKategori $kategori
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Tempat $tempat, TempatKategori $kategori)
    {
        return view('admin.pages.tempat.kategori.form', compact('tempat', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TempatKategoriRequest $request
     * @param Tempat $tempat
     * @param TempatKategori $kategori
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(TempatKategoriRequest $request, Tempat $tempat, TempatKategori $kategori)
    {
        $kategori->fill($request->validated());
        $kategori->save();

        return redirect(route('admin.tempats.kategori.index', $tempat));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tempat $tempat
     * @param TempatKategori $kategori
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Tempat $tempat, TempatKategori $kategori)
    {
        $kategori->delete();

        return redirect(route('admin.tempats.kategori.index', $tempat));
    }
}
