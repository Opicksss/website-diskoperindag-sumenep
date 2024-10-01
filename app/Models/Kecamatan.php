<?php

namespace App\Models;

use App\Models\CategoryKecamatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecamatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'ketua',
        'nik',
        'nomor',
        'tanggal',
        'alamat',
        'desa',
        'rat',
        'aset',
        'volume',
        'shu',
        'keterangan',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(CategoryKecamatan::class, 'category_id');
    }
}
