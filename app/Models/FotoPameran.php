<?php

namespace App\Models;

use App\Models\Pameran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FotoPameran extends Model
{
    use HasFactory;

    protected $fillable = ['pameran_id', 'foto'];

    public function fasilitass()
    {
        return $this->belongsTo(Pameran::class);
    }
}
