<?php

namespace App\Http\Controllers\koperasi;

use App\Http\Controllers\Controller;
use App\Models\KoperasiKelompok;
use Illuminate\Http\Request;

class AdminKoperasiKelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->Search;
        $kelompoks = KoperasiKelompok::query()
            ->where(function ($query) use ($search) {
                $query
                    ->where('koperasi_kelompoks.nama', 'LIKE', '%' . $search . '%')
                    ->orWhere('koperasi_kelompoks.jumlah', 'LIKE', '%' . $search . '%')
                    ->orWhere('koperasi_kelompoks.aktif', 'LIKE', '%' . $search . '%')
                    ->orWhere('koperasi_kelompoks.tidak_aktif', 'LIKE', '%' . $search . '%')
                    ->orWhere('koperasi_kelompoks.anggota', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('koperasi_kelompoks.created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        return view('admin.koperasi.kelompok.index', compact('kelompoks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'jumlah' => 'required|integer',
                'aktif' => 'required|integer',
                'tidak_aktif' => 'required|integer',
                'anggota' => 'required|integer',
                'file' => 'nullable|mimes:pdf,xlsx,xls,doc,docx', // Validasi file
            ]);

            if ($request->hasFile('file')) {
                $fileName = time() . '_' . $request->file->getClientOriginalName();
                $request->file->move(public_path('kelompok'), $fileName);
                $validatedData['file'] = $fileName;
            }

            KoperasiKelompok::create($validatedData);
            return redirect()->back()->with('success', 'Kelompok Berhasil di Tambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan kelompok. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KoperasiKelompok $koperasiKelompok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KoperasiKelompok $koperasiKelompok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KoperasiKelompok $koperasiKelompok)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'jumlah' => 'required|integer',
                'aktif' => 'required|integer',
                'tidak_aktif' => 'required|integer',
                'anggota' => 'required|integer',
                'file' => 'nullable|mimes:pdf,xlsx,xls,doc,docx',
            ]);

            if ($request->hasFile('file')) {
                $fileName = time() . '_' . $request->file->getClientOriginalName();
                $request->file->move(public_path('kelompok'), $fileName);
                $validatedData['file'] = $fileName;

                // Hapus file lama jika ada
                if ($koperasiKelompok->file) {
                    unlink(public_path('kelompok') . '/' . $koperasiKelompok->file);
                }
            } elseif ($request->has('delete_file') && $request->delete_file == 'on') {
                // Hapus file jika checkbox diaktifkan
                if ($koperasiKelompok->file) {
                    unlink(public_path('kelompok') . '/' . $koperasiKelompok->file);
                    $validatedData['file'] = null; // Set field file ke null
                }
            }

            $koperasiKelompok->update($validatedData);
            return redirect()->back()->with('success', 'Kelompok Berhasil di Perbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui kelompok. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KoperasiKelompok $koperasiKelompok)
    {
        try {
            if ($koperasiKelompok->file) {
                unlink(public_path('kelompok') . '/' . $koperasiKelompok->file);
            }
            $koperasiKelompok->delete();
            return redirect('/adminkoperasikelompok')->with('success', 'Kelompok Berhasil Dihapus!');
        } catch (\Exception $e) {
            return redirect('/adminkoperasikelompok')->with('error', 'Terjadi kesalahan saat menghapus kelompok. Silakan coba lagi.');
        }
    }
}
