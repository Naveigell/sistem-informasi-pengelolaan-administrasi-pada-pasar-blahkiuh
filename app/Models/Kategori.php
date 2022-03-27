<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method Builder|static withoutPedagang();
 * @method Builder|static withPedagang();
 * @property integer is_pedagang
 */
class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
        'is_pedagang',
        'is_automatic',
    ];

    public static function getDefaultValues()
    {
        return (object) [
            'nama_kategori' => '',
            'keterangan' => '',
        ];
    }

    /**
     * @param Builder $query
     */
    public function scopeWithoutPedagang($query)
    {
        $query->where('is_pedagang', 0);
    }

    /**
     * @param Builder $query
     */
    public function scopeWithPedagang($query)
    {
        $query->where('is_pedagang', 1);
    }

    public function pemasukan()
    {
        return $this->hasMany(Pemasukan::class);
    }

    public function setIsPedagangAttribute($value)
    {
        $this->attributes['is_pedagang'] = $value ? 1 : 0;
    }

    public function setIsAutomaticAttribute($value)
    {
        $this->attributes['is_automatic'] = $value ? 1 : 0;
    }
}
