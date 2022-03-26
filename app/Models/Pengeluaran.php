<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';

    protected $fillable = [
        'group_pengeluaran_id',
        'nama_pengeluaran',
        'nominal',
        'tgl',
        'keterangan',
        'bukti_pengeluaran',
        'user_id',
    ];

    public static function getDefaultValues()
    {
        return (object) [
            'nama_pengeluaran' => '',
            'nominal' => '',
            'tgl' => '',
            'keterangan' => '',
            'bukti_pengeluaran' => '',
            'user_id' => '',
            'jumlah' => '',
        ];
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tgl()
    {
        return new Attribute(
            get: fn ($value) => $value->format('d-m-Y'),
        );
    }
}
