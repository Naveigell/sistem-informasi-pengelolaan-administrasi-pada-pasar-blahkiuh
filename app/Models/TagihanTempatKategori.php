<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanTempatKategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'tagihan_id', 'tempat_kategori_id',
    ];
}
