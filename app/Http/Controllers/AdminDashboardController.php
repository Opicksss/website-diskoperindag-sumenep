<?php

namespace App\Http\Controllers;

use App\Models\Pameran;
use App\Models\Kelompok;
use App\Models\Fasilitas;
use App\Models\Kecamatan;
use App\Models\Kesehatan;
use App\Models\Pengawasan;
use App\Models\Penghargaan;
use Illuminate\Http\Request;
use App\Models\CategoryKelompok;
use App\Models\KoperasiKelompok;
use App\Models\CategoryKecamatan;
use App\Models\KoperasiKecamatan;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $data = [
            'kecamatan' => KoperasiKecamatan::count(),
            'kelompok' => KoperasiKelompok::count(),
            'pengawasan' => Pengawasan::count(),
            'fasilitas' => Fasilitas::count(),
            'kesehatan' => Kesehatan::count(),
            'pameran' => Pameran::count(),
            'penghargaan' => Penghargaan::count(),
            'categorykecamatan' => CategoryKecamatan::count(),
            'categorykelompok' => CategoryKelompok::count(),
            'kopkecamatan' => Kecamatan::count(),
            'kopkelompok' => Kelompok::count(),
        ];

        return view('admin.dashboard', $data);
    }
}
