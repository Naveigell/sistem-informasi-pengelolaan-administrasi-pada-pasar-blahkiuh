<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $kategori = Kategori::all();

        return view('admin.pages.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.pages.kategori.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(KategoriRequest $request)
    {
        $kategori = new Kategori($request->validated());
        $kategori->save();

        return redirect(route('admin.kategori.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Kategori $kategori
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Kategori $kategori)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Kategori $kategori
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Kategori $kategori)
    {
        return view('admin.pages.kategori.form', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param KategoriRequest $request
     * @param Kategori $kategori
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(KategoriRequest $request, Kategori $kategori)
    {
        $kategori->fill($request->validated());
        $kategori->save();

        return redirect(route('admin.kategori.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Kategori $kategori
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect(route('admin.kategori.index'));
    }
}
