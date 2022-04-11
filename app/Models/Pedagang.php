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
        'status',
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
            'status' => '',
        ];
    }

    public function tempat()
    {
        return $this->belongsTo(Tempat::class);
    }

    public function setTempatIdAttribute($value)
    {
        if (request()->isMethod('post')) {

            $positions = Pedagang::query()->where('status', 'active')->where('tempat_id', 1)->orderBy('position')->pluck('position');

            if ($positions->count() > 0) {
                $index     = 1;

                while ($positions->contains($index)) {
                    $index++;
                }

                $this->attributes['position'] = $index;

            } else {
                $this->attributes['position'] = 1;
            }
        }

        $this->attributes['tempat_id'] = $value;
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
