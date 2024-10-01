<?php

namespace App\Models;

use App\Models\Penghargaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FotoPenghargaan extends Model
{
    use HasFactory;

    protected $fillable = ['penghargaan_id', 'foto'];

    public function fasilitass()
    {
        return $this->belongsTo(Penghargaan::class);
    }
}
