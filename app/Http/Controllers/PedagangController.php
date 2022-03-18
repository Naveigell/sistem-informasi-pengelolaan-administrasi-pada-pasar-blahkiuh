<?php

namespace App\Http\Controllers;

use App\Models\Pedagang;
use App\Models\Tempat;
use Illuminate\Http\Request;

class PedagangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pedagang'] = Pedagang::with('tempat')->orderBy('nama', 'asc')->get();
        return view('pedagang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pedagang'] = Pedagang::getDefaultValues();
        $data['tempats']  = Tempat::all();

        return view('pedagang.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tempat_id' => 'required',
            'nama' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'no_telp' => 'required',
            'tgl_bergabung' => 'required',
        ]);
        $input = $request->toArray();
        $input['password'] = bcrypt($input['password']);
        Pedagang::create($input);
        return redirect()->route('pedagang.index')->with('success', 'Berhasil menambah data pedagang');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pedagang  $Pedagang
     * @return \Illuminate\Http\Response
     */
    public function show(Pedagang $Pedagang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pedagang  $Pedagang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['pedagang'] = Pedagang::findOrFail($id);
        return view('pedagang.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedagang  $Pedagang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'tgl_bergabung' => 'required',
        ]);

        $input = $request->toArray();
        if(empty($input['password'])) {
            unset($input['password']);
        } else {
            $input['password'] = bcrypt($input['password']);
        }

        Pedagang::findOrfail($id)->update($input);
        return redirect()->route('pedagang.index')->with('success', 'Berhasil mengubah data pedagang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedagang  $Pedagang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pedagang::findOrfail($id)->delete();
        return redirect()->route('pedagang.index')->with('success', 'Berhasil menghapus data pedagang');
    }
}
