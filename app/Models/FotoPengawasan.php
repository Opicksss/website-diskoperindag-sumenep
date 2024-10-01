<?php

namespace App\Models;

use App\Models\Pengawasan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FotoPengawasan extends Model
{
    use HasFactory;

    protected $fillable = ['pengawasan_id', 'foto'];

    public function pengawasans()
    {
        return $this->belongsTo(Pengawasan::class);
    }
}
