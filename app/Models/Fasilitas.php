<?php

namespace App\Models;

use App\Models\FotoFasilitas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fasilitas extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'tanggal'];

    public function fotos()
    {
        return $this->hasMany(FotoFasilitas::class);
    }
}
