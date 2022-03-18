<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatKategori extends Model
{
    use HasFactory;

    protected $table = 'tempat_kategori';

    protected $fillable = [
        'tempat_id', 'nama_kategori', 'keterangan', 'nominal',
    ];

    public function getNominalFormattedAttribute()
    {
        return number_format($this->nominal, 0, ',', '.');
    }
}
