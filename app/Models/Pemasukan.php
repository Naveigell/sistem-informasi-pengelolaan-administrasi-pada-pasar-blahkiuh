<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;

    protected $table = 'pemasukan';

    protected $fillable = [
        'kategori_id',
        'pedagang_id',
        'nominal',
        'tgl',
        'keterangan',
        'user_id'
    ];

    public static function getDefaultValues()
    {
        return (object) [
            'kategori_id' => '',
            'pedagang_id' => '',
            'nominal' => '',
            'tgl' => '',
            'keterangan' => '',
            'user_id' => ''
        ];
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function pedagang()
    {
        return $this->belongsTo('App\Models\Pedagang');
    }

    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori');
    }

    public function tgl()
    {
        return new Attribute(
            get: fn ($value) => $value->format('d-m-Y'),
        );
    }
}
