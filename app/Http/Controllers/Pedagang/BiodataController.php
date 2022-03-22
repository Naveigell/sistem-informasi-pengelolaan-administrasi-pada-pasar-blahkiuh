<?php

namespace App\Http\Controllers\Pedagang;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pedagang\BiodataPasswordRequest;
use App\Http\Requests\Pedagang\BiodataRequest;
use App\Models\Pedagang;
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
        $biodata = Pedagang::query()->where('id', auth('pedagang')->id())->first();

        return view('pedagang.pages.biodata.form', compact('biodata'));
    }

    public function store(BiodataRequest $request)
    {
        $user = Pedagang::query()->findOrFail(auth('pedagang')->id());
        $user->fill($request->validated());
        $user->save();

        return redirect(route('pedagang.biodata.index'))->with('success', 'Ubah biodata berhasil');
    }

    public function password(BiodataPasswordRequest $request)
    {
        if (!Hash::check($request->old_password, auth('pedagang')->user()->password)) {
            return back()->withErrors(["old_password" => "Your old password is wrong!"])->withInput();
        }

        $user = Pedagang::query()->findOrFail(auth('pedagang')->id());
        $user->fill($request->validated());
        $user->save();

        return redirect(route('pedagang.biodata.index'))->with('success', 'Ubah password berhasil');
    }
}
