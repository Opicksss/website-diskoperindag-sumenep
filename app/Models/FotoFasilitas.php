<?php

namespace App\Models;

use App\Models\Fasilitas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FotoFasilitas extends Model
{
    use HasFactory;

    protected $fillable = ['fasilitas_id', 'foto'];

    public function fasilitass()
    {
        return $this->belongsTo(Fasilitas::class);
    }
}
