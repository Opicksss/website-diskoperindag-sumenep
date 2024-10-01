<?php

namespace App\Models;

use App\Models\FotoPameran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pameran extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'tanggal'];

    public function fotos()
    {
        return $this->hasMany(FotoPameran::class);
    }
}
