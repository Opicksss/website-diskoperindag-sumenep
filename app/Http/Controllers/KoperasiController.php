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

class KoperasiController extends Controller
{
    public function kecamatan()
    {
        $kecamatans = KoperasiKecamatan::all();
        $total = [
            'data' => KoperasiKecamatan::count(),
            'jumlah' => $kecamatans->sum('jumlah'),
            'aktif' => $kecamatans->sum('aktif'),
            'tidak_aktif' => $kecamatans->sum('tidak_aktif'),
            'anggota' => $kecamatans->sum('anggota'),
        ];

        return view('user.koperasi.kecamatan', compact('kecamatans', 'total'));
    }

    public function kopkecamatan($category_id)
    {
        $category = CategoryKecamatan::findOrFail($category_id);
        $kecamatans = Kecamatan::where('category_id', $category_id)->get();

        return view('user.koperasi.kopkecamatan', compact('kecamatans', 'category'));
    }

    public function categorykecamatan()
    {
        $categories = CategoryKecamatan::withCount([
            'kecamatans as total' => function ($query) {
                $query->where('keterangan', '!=', '');
            },
            'kecamatans as aktif' => function ($query) {
                $query->where('keterangan', 'aktif');
            },
            'kecamatans as tidak_aktif' => function ($query) {
                $query->where('keterangan', 'tidak aktif');
            },
        ])->get();

        $total = [
            'data' => CategoryKecamatan::count(),
            'jumlah' => Kecamatan::count(),
            'aktif' => Kecamatan::where('keterangan', 'aktif')->count(),
            'tidak_aktif' => Kecamatan::where('keterangan', 'tidak aktif')->count(),
        ];

        return view('user.koperasi.categorykecamatan', compact('categories', 'total'));
    }

    public function kelompok()
    {
        $kelompoks = KoperasiKelompok::all();
        $total = [
            'data' => KoperasiKelompok::count(),
            'jumlah' => $kelompoks->sum('jumlah'),
            'aktif' => $kelompoks->sum('aktif'),
            'tidak_aktif' => $kelompoks->sum('tidak_aktif'),
            'anggota' => $kelompoks->sum('anggota'),
        ];

        return view('user.koperasi.kelompok', compact('kelompoks', 'total'));
    }

     public function kopkelompok($category_id)
    {
        $category = CategoryKelompok::findOrFail($category_id);
        $kelompoks = Kelompok::where('category_id', $category_id)->get();

        return view('user.koperasi.kopkelompok', compact('kelompoks', 'category'));
    }

    public function categorykelompok()
    {
        $categories = CategoryKelompok::withCount([
            'kelompoks as total' => function ($query) {
                $query->where('keterangan', '!=', '');
            },
            'kelompoks as aktif' => function ($query) {
                $query->where('keterangan', 'aktif');
            },
            'kelompoks as tidak_aktif' => function ($query) {
                $query->where('keterangan', 'tidak aktif');
            },
        ])->get();

        $total = [
            'data' => CategoryKelompok::count(),
            'jumlah' => Kelompok::count(),
            'aktif' => Kelompok::where('keterangan', 'aktif')->count(),
            'tidak_aktif' => Kelompok::where('keterangan', 'tidak aktif')->count(),
        ];

        return view('user.koperasi.categorykelompok', compact('categories', 'total'));
    }

    public function pengawasan(Request $request)
    {
        $search = $request->Search;
        $pengawasan = Pengawasan::query();
        if ($search) {
            $pengawasan->where(function ($query) use ($search) {
                $query
                    ->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%')
                    ->orWhere('tanggal', 'LIKE', '%' . $search . '%');
            });
        }
        $pengawasans = $pengawasan->with('fotos')->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        return view('user.koperasi.pengawasan', compact('pengawasans'));
    }

    public function show_pengawasan(Pengawasan $pengawasan)
    {
        $terbaru = Pengawasan::with('fotos')->latest()->take(5)->get();
        return view('user.koperasi.detail.detail_pengawasan', compact('pengawasan', 'terbaru'));
    }

    public function kesehatan(Request $request)
    {
        $search = $request->Search;
        $kesehatan = Kesehatan::query();
        if ($search) {
            $kesehatan->where(function ($query) use ($search) {
                $query
                    ->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%')
                    ->orWhere('tanggal', 'LIKE', '%' . $search . '%');
            });
        }
        $kesehatans = $kesehatan->with('fotos')->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        return view('user.koperasi.kesehatan', compact('kesehatans'));
    }

    public function show_kesehatan(Kesehatan $kesehatan)
    {
        $terbaru = Kesehatan::with('fotos')->latest()->take(5)->get();
        return view('user.koperasi.detail.detail_kesehatan', compact('kesehatan', 'terbaru'));
    }

    public function fasilitas(Request $request)
    {
        $search = $request->Search;
        $fasilitas = Fasilitas::query();
        if ($search) {
            $fasilitas->where(function ($query) use ($search) {
                $query
                    ->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%')
                    ->orWhere('tanggal', 'LIKE', '%' . $search . '%');
            });
        }
        $fasilitass = $fasilitas->with('fotos')->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        return view('user.koperasi.fasilitas', compact('fasilitass'));
    }

    public function show_fasilitas(Fasilitas $fasilitas)
    {
        $terbaru = Fasilitas::with('fotos')->latest()->take(5)->get();
        return view('user.koperasi.detail.detail_fasilitas', compact('fasilitas', 'terbaru'));
    }

    public function penghargaan(Request $request)
    {
        $search = $request->Search;
        $penghargaan = Penghargaan::query();
        if ($search) {
            $penghargaan->where(function ($query) use ($search) {
                $query
                    ->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%')
                    ->orWhere('tanggal', 'LIKE', '%' . $search . '%');
            });
        }
        $penghargaans = $penghargaan->with('fotos')->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        return view('user.koperasi.penghargaan', compact('penghargaans'));
    }

    public function show_penghargaan(Penghargaan $penghargaan)
    {
        $terbaru = Penghargaan::with('fotos')->latest()->take(5)->get();
        return view('user.koperasi.detail.detail_penghargaan', compact('penghargaan', 'terbaru'));
    }

    public function pameran(Request $request)
    {
        $search = $request->Search;
        $pameran = Pameran::query();
        if ($search) {
            $pameran->where(function ($query) use ($search) {
                $query
                    ->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%')
                    ->orWhere('tanggal', 'LIKE', '%' . $search . '%');
            });
        }
        $pamerans = $pameran->with('fotos')->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        return view('user.koperasi.pameran', compact('pamerans'));
    }

    public function show_pameran(Pameran $pameran)
    {
        $terbaru = Pameran::with('fotos')->latest()->take(5)->get();
        return view('user.koperasi.detail.detail_pameran', compact('pameran', 'terbaru'));
    }
}
