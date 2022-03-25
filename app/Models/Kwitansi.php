<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kwitansi extends Model
{
    use HasFactory;

    protected $table = 'kwitansi';

    protected $fillable = [
        'no_kwitansi',
        'pedagang_id',
        'tgl',
        'nominal',
        'terbilang',
        'keterangan',
    ];

    public static function getDefaultValues()
    {
        return (object) [
            'no_kwitansi' => '',
            'pedagang_id' => '',
            'tgl' => '',
            'nominal' => '',
            'terbilang' => '',
            'keterangan' => '',
        ];
    }

    public function setPedagangIdAttribute($value)
    {
        $this->attributes['pedagang_id'] = $value;
        $this->attributes['terbilang'] = $this->terbilang($this->nominal);

        $index      = 1;
        $latestItem = Kwitansi::query()->latest()->first();

        if ($latestItem) {
            $index = $latestItem->id + 1;
        }

        $this->attributes['no_kwitansi'] = 'KW-' . str_repeat('0', 4 - strlen((string) $index)) . $index;
    }

    public function pedagang()
    {
        return $this->belongsTo('App\Models\Pedagang');
    }

    public function tgl()
    {
        return new Attribute(
            get: fn ($value) => $value->format('d-m-Y'),
        );
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
