<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_tagihan', 'tempat_kategori_id', 'pedagang_id', 'nominal',
    ];

    public function setPedagangIdAttribute($value)
    {
        $this->attributes['pedagang_id'] = $value;

        $index      = 1;
        $latestItem = self::query()->latest()->first();

        if ($latestItem) {
            $index = $latestItem->id + 1;
        }

        $this->attributes['no_tagihan'] = 'TG-' . str_repeat('0', 4 - strlen((string) $index)) . $index;
    }

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
