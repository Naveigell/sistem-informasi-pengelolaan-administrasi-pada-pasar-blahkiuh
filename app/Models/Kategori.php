<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer is_pedagang
 */
class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
        'is_pedagang'
    ];

    public static function getDefaultValues()
    {
        return (object) [
            'nama_kategori' => '',
            'keterangan' => '',
        ];
    }

    public function pemasukan()
    {
        return $this->hasMany(Pemasukan::class);
    }

    public function setIsPedagangAttribute($value)
    {
        $this->attributes['is_pedagang'] = $value ? 1 : 0;
    }
}
