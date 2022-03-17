<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagihanRequest;
use App\Models\JenisTagihan;
use App\Models\Pedagang;
use App\Models\Tagihan;
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
        $tagihans = Tagihan::with('pedagang', 'jenisTagihan')->get();

        return view('admin.pages.tagihan.index', compact('tagihans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $jenisTagihans = JenisTagihan::all();
        $pedagangs     = Pedagang::all();

        return view('admin.pages.tagihan.form', compact('jenisTagihans', 'pedagangs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagihanRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TagihanRequest $request)
    {
        $tagihan = new Tagihan($request->validated());
        $tagihan->save();

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
        $tagihan->load('pedagang', 'jenisTagihan');

        $jenisTagihans = JenisTagihan::all();
        $pedagangs     = Pedagang::all();

        return view('admin.pages.tagihan.form', compact('tagihan', 'jenisTagihans', 'pedagangs'));
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
