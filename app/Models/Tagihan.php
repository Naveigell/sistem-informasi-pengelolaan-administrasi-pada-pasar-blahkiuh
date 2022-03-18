<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tempat_kategori_id', 'pedagang_id', 'nominal',
    ];

    public function jenisTagihan()
    {
        return $this->belongsTo(JenisTagihan::class);
    }

    public function pedagang()
    {
        return $this->belongsTo(Pedagang::class);
    }

    public function tempatKategori()
    {
        return $this->belongsTo(TempatKategori::class, 'tempat_kategori_id');
    }
}
