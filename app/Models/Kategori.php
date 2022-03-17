<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
        'keterangan'
    ];

    public static function getDefaultValues()
    {
        return (object) [
            'nama_kategori' => '',
            'keterangan' => '',
        ];
    }
}
