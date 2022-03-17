<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pedagang;
use App\Models\Pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->guard('web')->check()) {
            $data['pemasukan'] = Pemasukan::orderBy('tgl', 'desc')->get();
        } else {
            $data['pemasukan'] = Pemasukan::where('pedagang_id', auth()->user()->id)->orderBy('tgl', 'desc')->get();
        }
        return view('pemasukan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pemasukan'] = Pemasukan::getDefaultValues();
        $data['pedagang'] = Pedagang::orderBy('nama', 'asc')->get();
        $data['kategori'] = Kategori::orderBy('nama_kategori', 'asc')->get();
        return view('pemasukan.form', $data);
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
            'tgl' => 'required',
            'nominal' => 'required',
        ]);
        $input = $request->toArray();
        $input['user_id'] = auth()->user()->id;
        Pemasukan::create($input);
        return redirect()->route('pemasukan.index')->with('success', 'Berhasil menambah data pemasukan');
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
        $data['pemasukan'] = Pemasukan::findOrFail($id);
        $data['pedagang'] = Pedagang::orderBy('nama', 'asc')->get();
        $data['kategori'] = Kategori::orderBy('nama_kategori', 'asc')->get();
        return view('pemasukan.form', $data);
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
        $request->validate([
            'tgl' => 'required',
            'nominal' => 'required',
        ]);
        $input = $request->toArray();
        $input['user_id'] = auth()->user()->id;
        Pemasukan::find($id)->update($input);
        return redirect()->route('pemasukan.index')->with('success', 'Berhasil mengubah data pemasukan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pemasukan::findOrfail($id)->delete();
        return redirect()->route('pemasukan.index')->with('success', 'Berhasil menghapus data pemasukan');
    }

    public function laporan()
    {
        $data['pemasukan'] = [];
        if(request('jenis_cukai') == 'harian') {
            $data['pemasukan'] = Pemasukan::where('tgl', request('tgl'))->get();
        } else {
            $data['pemasukan'] = Pemasukan::whereYear('tgl', request('tahun'))->whereMonth('tgl', request('bulan'))->get();
        }
        return view('pemasukan.laporan', $data);
    }

    public function cetak()
    {
        $data['pemasukan'] = [];
        if(request('jenis_cukai') == 'harian') {
            $data['pemasukan'] = Pemasukan::where('tgl', request('tgl'))->get();
        } else {
            $data['pemasukan'] = Pemasukan::whereYear('tgl', request('tahun'))->whereMonth('tgl', request('bulan'))->get();
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pemasukan.cetak', $data);
        return $pdf->stream();
    }
}
