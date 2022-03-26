<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupPengeluaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_invoice', 'tgl', 'sub_total',
    ];

    public function pengeluaran()
    {
        return $this->hasMany(Pengeluaran::class);
    }
}
