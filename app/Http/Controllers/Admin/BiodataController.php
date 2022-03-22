<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BiodataPasswordRequest;
use App\Http\Requests\Admin\BiodataRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $biodata = User::query()->where('id', auth('web')->id())->first();

        return view('admin.pages.biodata.form', compact('biodata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BiodataRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(BiodataRequest $request)
    {
        $user = User::query()->findOrFail(auth('web')->id());
        $user->fill($request->validated());
        $user->save();

        return redirect(route('admin.biodata.index'))->with('success', 'Ubah biodata berhasil');
    }

    public function password(BiodataPasswordRequest $request)
    {
        if (!Hash::check($request->old_password, auth('web')->user()->password)) {
            return back()->withErrors(["old_password" => "Your old password is wrong!"])->withInput();
        }

        $user = User::query()->findOrFail(auth('web')->id());
        $user->fill($request->validated());
        $user->save();

        return redirect(route('admin.biodata.index'))->with('success', 'Ubah password berhasil');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
