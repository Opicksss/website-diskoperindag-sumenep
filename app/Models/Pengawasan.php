<?php

namespace App\Models;

use App\Models\FotoPengawasan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengawasan extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'tanggal'];

    public function fotos()
    {
        return $this->hasMany(FotoPengawasan::class);
    }

}
