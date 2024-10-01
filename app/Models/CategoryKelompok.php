<?php

namespace App\Models;

use App\Models\Kelompok;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryKelompok extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function kelompoks()
    {
        return $this->hasMany(Kelompok::class, 'category_id');
    }
}
