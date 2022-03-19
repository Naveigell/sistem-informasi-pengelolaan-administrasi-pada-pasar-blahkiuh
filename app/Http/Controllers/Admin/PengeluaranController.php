<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data['pengeluaran'] = Pengeluaran::orderBy('tgl', 'desc')->get();

        return view('admin.pages.pengeluaran.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $data['pengeluaran'] = Pengeluaran::getDefaultValues();

        return view('admin.pages.pengeluaran.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengeluaran' => 'required',
            'tgl' => 'required',
            'nominal' => 'required',
            'bukti_pengeluaran' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        $path = $request->file('bukti_pengeluaran')->store('bukti_pengeluaran');
        $input = $request->toArray();
        $input['user_id'] = auth()->user()->id;
        $input['bukti_pengeluaran'] = $path;

        Pengeluaran::create($input);

        return redirect()->route('admin.pengeluaran.index')->with('success', 'Berhasil menambah data pengeluaran');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $data['pengeluaran'] = Pengeluaran::findOrFail($id);

        return view('admin.pages.pengeluaran.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pengeluaran' => 'required',
            'tgl' => 'required',
            'nominal' => 'required',
            'bukti_pengeluaran' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        $path = $request->file('bukti_pengeluaran')->store('bukti_pengeluaran');
        $input = $request->toArray();
        $input['user_id'] = auth()->user()->id;
        $input['bukti_pengeluaran'] = $path;

        Pengeluaran::find($id)->update($input);

        return redirect()->route('admin.pengeluaran.index')->with('success', 'Berhasil mengubah data pengeluaran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Pengeluaran::findOrfail($id)->delete();

        return redirect()->route('pengeluaran.index')->with('success', 'Berhasil menghapus data pengeluaran');
    }

    public function laporan()
    {
        $data['pengeluaran'] = [];
        if (request('bulan')) {
            $data['pengeluaran'] = Pengeluaran::whereYear('tgl', request('tahun'))->whereMonth('tgl', request('bulan'))->get();
        }
        return view('admin.pages.pengeluaran.laporan', $data);
    }

    public function cetak()
    {
        $data['pengeluaran'] = [];
        if (request('bulan')) {
            $data['pengeluaran'] = Pengeluaran::whereYear('tgl', request('tahun'))->whereMonth('tgl', request('bulan'))->get();
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('admin.pages.pengeluaran.cetak', $data);
        return $pdf->stream();
    }
}
