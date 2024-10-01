<?php

namespace App\Models;

use App\Models\FotoPenghargaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penghargaan extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'tanggal'];

    public function fotos()
    {
        return $this->hasMany(FotoPenghargaan::class);
    }
}
