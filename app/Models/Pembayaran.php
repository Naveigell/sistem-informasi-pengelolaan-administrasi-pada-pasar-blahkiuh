<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'pedagang_id',
        'kategori_id',
        'tagihan_id',
        'nominal',
        'tgl',
        'bukti_pembayaran',
        'status',
        'keterangan',
    ];

    public function pedagang()
    {
        return $this->belongsTo('App\Models\Pedagang');
    }

    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori');
    }

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }

    public function kwitansi()
    {
        return $this->hasOne(Kwitansi::class, 'pembayaran_id');
    }

    public function isTunai()
    {
        return !$this->bukti_pembayaran;
    }

    public static function getDefaultValues()
    {
        return (object) [
            'pedagang_id' => '',
            'kategori_id' => '',
            'tagihan_id' => '',
            'nominal' => '',
            'tgl' => '',
            'bukti_pembayaran' => '',
            'status' => '',
            'keterangan' => '',
        ];
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: function($value) {
                if ($value == 0) {
                    return 'Pending';
                }

                if ($value == 1) {
                    return 'Acc';
                }

                if ($value == 2) {
                    return 'Ditolak';
                }
            }
        );
    }
}
