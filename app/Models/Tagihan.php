<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_tagihan_id', 'pedagang_id', 'nominal',
    ];

    public function jenisTagihan()
    {
        return $this->belongsTo(JenisTagihan::class);
    }

    public function pedagang()
    {
        return $this->belongsTo(Pedagang::class);
    }
}
