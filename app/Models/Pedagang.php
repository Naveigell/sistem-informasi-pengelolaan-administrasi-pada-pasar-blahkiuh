<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Pedagang extends Authenticatable
{
    use HasFactory;

    protected $table = 'pedagang';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'lokasi',
        'no_telp',
        'tgl_bergabung'
    ];

    public static function getDefaultValues()
    {
        return (object) [
            'nama' => '',
            'email' => '',
            'lokasi' => '',
            'no_telp' => '',
            'tgl_bergabung' => ''
        ];
    }
}
