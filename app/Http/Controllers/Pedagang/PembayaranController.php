<?php

namespace App\Http\Controllers\Pedagang;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Pedagang;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data['pembayaran'] = Pembayaran::with('tagihan')->where('pedagang_id', auth()->user()->id)->orderBy('tgl', 'desc')->get();

        return view('pedagang.pages.pembayaran.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $data['pembayaran'] = Pembayaran::getDefaultValues();
        $data['pedagang'] = Pedagang::orderBy('nama', 'asc')->get();
        $data['kategori'] = Kategori::orderBy('nama_kategori', 'asc')->get();
        $data['tagihans'] = Tagihan::isNotLunas()->with('pedagang', 'tempatKategori')->where('pedagang_id', auth()->id())->get();

        return view('pedagang.pages.pembayaran.form', $data);
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
            'tgl' => 'required',
            'nominal' => 'required',
            'kategori_id' => 'required',
            'bukti_pembayaran' => 'required',
            'keterangan' => 'required',
        ]);
        $input = $request->toArray();
        $input['pedagang_id'] = auth()->user()->id;
        $input['status'] = 0;

        $path = $request->file('bukti_pembayaran')->store('public/bukti_pembayaran');
        $input['bukti_pembayaran'] = $path;

        Pembayaran::create($input);

        return redirect()->route('pedagang.pembayaran.index')->with('success', 'Berhasil menambah data pembayaran');
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
        $data['pembayaran'] = Pembayaran::findOrFail($id);
        $data['pedagang'] = Pedagang::orderBy('nama', 'asc')->get();
        $data['kategori'] = Kategori::orderBy('nama_kategori', 'asc')->get();

        return view('pedagang.pages.pembayaran.form', $data);
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
        Pembayaran::find($id)->update($request->toArray());
        if ($request->status == 1) {
            $text = 'acc';
        } else if ($request->status == 2) {
            $text = 'menolak';
        }
        return redirect()->back()->with('success', 'Berhasil ' . $text . ' pembayaran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrfail($id);

        Storage::delete($pembayaran->bukti_pembayaran);

        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Berhasil menghapus data pembayaran');
    }
}
