<?php

namespace App\Http\Controllers;

use App\Models\Kwitansi;
use App\Models\Pedagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class KwitansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['kwitansi'] = Kwitansi::orderBy('no_kwitansi', 'asc')->get();
        return view('kwitansi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['kwitansi'] = Kwitansi::getDefaultValues();
        $data['pedagang'] = Pedagang::orderBy('nama', 'asc')->get();
        return view('kwitansi.form', $data);
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
            'no_kwitansi' => 'required|unique:kwitansi,no_kwitansi',
            'pedagang_id' => 'required',
            'tgl' => 'required',
            'nominal' => 'required',
            'keterangan' => 'required',
        ]);
        $input = $request->toArray();
        $input['terbilang'] = $this->terbilang($input['nominal']);
        Kwitansi::create($input);
        return redirect()->route('kwitansi.index')->with('success', 'Berhasil menambah data kwitansi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\kwitansi  $kwitansi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['kwitansi'] = Kwitansi::find($id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('a5', 'landscape');
        $pdf->loadView('kwitansi.show', $data);
        return $pdf->stream();
        //return view('kwitansi.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\kwitansi  $kwitansi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['kwitansi'] = Kwitansi::findOrFail($id);
        $data['pedagang'] = Pedagang::orderBy('nama', 'asc')->get();
        return view('kwitansi.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\kwitansi  $kwitansi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'no_kwitansi' => 'required',
            'pedagang_id' => 'required',
            'tgl' => 'required',
            'nominal' => 'required',
            'keterangan' => 'required',
        ]);
        $input = $request->toArray();
        $input['terbilang'] = $this->terbilang($input['nominal']);
        Kwitansi::findOrfail($id)->update($input);
        return redirect()->route('kwitansi.index')->with('success', 'Berhasil mengubah data kwitansi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kwitansi  $kwitansi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kwitansi::findOrfail($id)->delete();
        return redirect()->route('kwitansi.index')->with('success', 'Berhasil menghapus data kwitansi');
    }

    private function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = $this->penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . $this->penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . $this->penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
		}
		return $temp;
	}

	private function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim($this->penyebut($nilai));
		} else {
			$hasil = trim($this->penyebut($nilai));
		}
		return $hasil . ' rupiah';
	}
}
