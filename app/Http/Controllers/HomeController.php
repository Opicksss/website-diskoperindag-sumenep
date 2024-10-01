<?php

namespace App\Http\Controllers;

use App\Models\Pameran;
use App\Models\Fasilitas;
use App\Models\Kesehatan;
use App\Models\Pengawasan;
use App\Models\Penghargaan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $pamerans = Pameran::orderBy('tanggal', 'desc')
            ->take(4)
            ->get();
        $pengawasans = Pengawasan::orderBy('tanggal', 'desc')
            ->take(3)
            ->get();
        $kesehatans = Kesehatan::orderBy('tanggal', 'desc')
            ->take(4)
            ->get();
        $fasilitass = Fasilitas::orderBy('tanggal', 'desc')
            ->take(3)
            ->get();
        $penghargaans = Penghargaan::orderBy('tanggal', 'desc')
            ->take(4)
            ->get();
        return view('home', compact('pamerans', 'pengawasans', 'kesehatans', 'fasilitass', 'penghargaans'));
    }
}
