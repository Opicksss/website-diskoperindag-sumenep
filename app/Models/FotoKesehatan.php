<?php

namespace App\Models;

use App\Models\Kesehatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FotoKesehatan extends Model
{
    use HasFactory;

    protected $fillable = ['kesehatan_id', 'foto'];

    public function kesehatans()
    {
        return $this->belongsTo(Kesehatan::class);
    }
}
