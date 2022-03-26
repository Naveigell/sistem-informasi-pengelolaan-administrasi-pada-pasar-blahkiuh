<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;

class Pedagang extends Authenticatable
{
    use HasFactory;

    protected $table = 'pedagang';

    protected $fillable = [
        'tempat_id',
        'nama',
        'email',
        'password',
        'lokasi',
        'no_telp',
        'tgl_bergabung',
        'alamat',
        'jenis_dagangan',
    ];

    public static function getDefaultValues()
    {
        return (object) [
            'tempat_id' => '',
            'nama' => '',
            'email' => '',
            'lokasi' => '',
            'no_telp' => '',
            'tgl_bergabung' => '',
            'alamat' => '',
            'jenis_dagangan' => '',
        ];
    }

    public function tempat()
    {
        return $this->belongsTo(Tempat::class);
    }

    public function setTempatIdAttribute($value)
    {
        if (request()->isMethod('post')) {
            $max = Pedagang::query()->where('tempat_id', $value)->max('position');
            $this->attributes['position']  = $max ? $max + 1 : 1;
        }

        $this->attributes['tempat_id'] = $value;
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
