<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PemasukanRequest;
use App\Models\Kategori;
use App\Models\Pedagang;
use App\Models\Pemasukan;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Kategori $kategori
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Kategori $kategori)
    {
        $kategori->load('pemasukan');

        return view('admin.pages.pemasukan.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Kategori $kategori
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Kategori $kategori)
    {
        $pedagangs = collect();

        if ($kategori->is_pedagang) {
            $pedagangs = Pedagang::with('tempat.tempatKategori')->get();
        }

        return view('admin.pages.pemasukan.form', compact('kategori', 'pedagangs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PemasukanRequest $request
     * @param Kategori $kategori
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PemasukanRequest $request, Kategori $kategori)
    {
        $data = $request->validated();

        if ($kategori->is_pedagang) {
            $data['pedagang_id'] = $request->pedagang_id;
        }

        $pemasukan = new Pemasukan(
            array_merge(
                $data, ["user_id" => auth()->id()],
            )
        );
        $pemasukan->save();

        return redirect(route('admin.kategori.pemasukan.index', $kategori));
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
     * @param Kategori $kategori
     * @param Pemasukan $pemasukan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Kategori $kategori, Pemasukan $pemasukan)
    {
        $pemasukan->load('pedagang.tempat.tempatKategori');
        $pedagangs = collect();

        if ($kategori->is_pedagang) {
            $pedagangs = Pedagang::with('tempat.tempatKategori')->get();
        }

        return view('admin.pages.pemasukan.form', compact('pemasukan', 'kategori', 'pedagangs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PemasukanRequest $request
     * @param Kategori $kategori
     * @param Pemasukan $pemasukan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(PemasukanRequest $request, Kategori $kategori, Pemasukan $pemasukan)
    {
        $data = $request->validated();

        if ($kategori->is_pedagang) {
            $data['pedagang_id'] = $request->pedagang_id;
        }

        $pemasukan->fill(
            array_merge(
                $data, ["user_id" => auth()->id()],
            )
        );
        $pemasukan->save();

        return redirect(route('admin.kategori.pemasukan.index', $kategori));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Kategori $kategori
     * @param Pemasukan $pemasukan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Kategori $kategori, Pemasukan $pemasukan)
    {
        $pemasukan->delete();

        return redirect(route('admin.kategori.pemasukan.index', $kategori));
    }
}
