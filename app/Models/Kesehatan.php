<?php

namespace App\Models;

use App\Models\FotoKesehatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kesehatan extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'tanggal'];

    public function fotos()
    {
        return $this->hasMany(FotoKesehatan::class);
    }
}
