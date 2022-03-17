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
}
