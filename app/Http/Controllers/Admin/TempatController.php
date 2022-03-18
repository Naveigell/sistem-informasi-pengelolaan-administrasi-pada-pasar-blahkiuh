<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TempatRequest;
use App\Models\Tempat;
use Illuminate\Http\Request;

class TempatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tempats = Tempat::all();

        return view('admin.pages.tempat.index', compact('tempats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.pages.tempat.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TempatRequest $request)
    {
        $tempat = new Tempat($request->validated());
        $tempat->save();

        return redirect(route('admin.tempats.index'));
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Tempat $tempat)
    {
        return view('admin.pages.tempat.form', compact('tempat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TempatRequest $request
     * @param Tempat $tempat
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(TempatRequest $request, Tempat $tempat)
    {
        $tempat->fill($request->validated());
        $tempat->save();

        return redirect(route('admin.tempats.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tempat $tempat
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Tempat $tempat)
    {
        $tempat->delete();

        return redirect(route('admin.tempats.index'));
    }
}
