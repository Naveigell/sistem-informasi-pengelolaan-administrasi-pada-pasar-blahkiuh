<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Kwitansi;
use App\Models\Pedagang;
use App\Models\Pemasukan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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

        if (auth()->guard('web')->check()) {
            $pembayaran = Pembayaran::with('kwitansi')->orderBy('tgl', 'desc');
        } else {
            $pembayaran = Pembayaran::with('kwitansi')->where('pedagang_id', auth()->user()->id)->orderBy('tgl', 'desc');
        }

        if (\request()->query('type') === 'non-tunai') {
            $pembayaran = $pembayaran->whereNotNull('bukti_pembayaran')->get();
        } else {
            $pembayaran = $pembayaran->whereNull('bukti_pembayaran')->get();
        }

        return view('admin.pages.pembayaran.index', compact('pembayaran'));
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

        return view('admin.pages.pembayaran.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $input = [];
        if (auth()->guard('web')->check()) {
            $request->validate([
                'tgl' => 'required',
                'nominal' => 'required',
                'kategori_id' => 'required',
                'pedagang_id' => 'required',
                'status' => 'required'
            ]);

            $input = $request->toArray();
            $redirect = 'admin.pembayaran.index';
        } else {
            $request->validate([
                'tgl' => 'required',
                'nominal' => 'required',
                'kategori_id' => 'required',
            ]);
            $input = $request->toArray();
            $input['pedagang_id'] = auth()->user()->id;
            $input['status'] = 0;
            $redirect = 'admin.pembayaran.index';
        }

        if ($request->hasFile('bukti_pembayaran')) {

            $path = $request->file('bukti_pembayaran')->store('public/bukti_pembayaran');
            $input['bukti_pembayaran'] = $path;

        }

        $pembayaran = Pembayaran::create($input);

        return redirect(route($redirect, ["type" => $pembayaran->bukti_pembayaran ? "non-tunai" : "tunai"]))->with('success', 'Berhasil menambah data pembayaran');
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

        return view('admin.pages.pembayaran.form', $data);
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
        $pembayaran = Pembayaran::with('kategori')->findOrFail($id);
        $pembayaran->update($request->toArray());

        if ($request->status == 1) {
            $text = 'acc';

            if ($pembayaran->kategori->is_automatic) {

                Pemasukan::query()->create([
                    "pedagang_id" => $pembayaran->pedagang_id,
                    "kategori_id" => $pembayaran->kategori_id,
                    "nominal" => $pembayaran->nominal,
                    "tgl" => $pembayaran->tgl,
                    "keterangan" => $pembayaran->keterangan,
                    "user_id" => auth('web')->id(),
                ]);

            }

            Kwitansi::query()->create([
                "pembayaran_id" => $pembayaran->id,
                "pedagang_id" => $pembayaran->pedagang_id,
                "tgl" => $pembayaran->tgl,
                "nominal" => $pembayaran->nominal,
                "keterangan" => $pembayaran->kategori->nama_kategori,
            ]);

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

        return redirect()->route('admin.pembayaran.index')->with('success', 'Berhasil menghapus data pembayaran');
    }
}
