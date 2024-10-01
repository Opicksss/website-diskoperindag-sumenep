<?php

namespace App\Http\Controllers\koperasi;

use App\Http\Controllers\Controller;
use App\Models\KoperasiKecamatan;
use Illuminate\Http\Request;

class AdminKoperasiKecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->Search;
        $kecamatans = KoperasiKecamatan::query()
            ->where(function ($query) use ($search) {
                $query
                    ->where('koperasi_kecamatans.nama', 'LIKE', '%' . $search . '%')
                    ->orWhere('koperasi_kecamatans.jumlah', 'LIKE', '%' . $search . '%')
                    ->orWhere('koperasi_kecamatans.aktif', 'LIKE', '%' . $search . '%')
                    ->orWhere('koperasi_kecamatans.tidak_aktif', 'LIKE', '%' . $search . '%')
                    ->orWhere('koperasi_kecamatans.anggota', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('koperasi_kecamatans.created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        return view('admin.koperasi.kecamatan.index', compact('kecamatans'));
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
                $request->file->move(public_path('kecamatan'), $fileName);
                $validatedData['file'] = $fileName;
            }

            KoperasiKecamatan::create($validatedData);
            return redirect()->back()->with('success', 'Kecamatan Berhasil di Tambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan kecamatan. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KoperasiKecamatan $koperasiKecamatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KoperasiKecamatan $koperasiKecamatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KoperasiKecamatan $koperasiKecamatan)
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

            // Cek apakah file baru diunggah
            if ($request->hasFile('file')) {
                $fileName = time() . '_' . $request->file->getClientOriginalName();
                $request->file->move(public_path('kecamatan'), $fileName);
                $validatedData['file'] = $fileName;

                // Hapus file lama jika ada
                if ($koperasiKecamatan->file) {
                    unlink(public_path('kecamatan') . '/' . $koperasiKecamatan->file);
                }
            } elseif ($request->has('delete_file') && $request->delete_file == 'on') {
                // Hapus file jika checkbox diaktifkan
                if ($koperasiKecamatan->file) {
                    unlink(public_path('kecamatan') . '/' . $koperasiKecamatan->file);
                    $validatedData['file'] = null; // Set field file ke null
                }
            }

            $koperasiKecamatan->update($validatedData);
            return redirect()->back()->with('success', 'Kecamatan Berhasil di Perbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui kecamatan. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KoperasiKecamatan $koperasiKecamatan)
    {
        try {
            if ($koperasiKecamatan->file) {
                unlink(public_path('kecamatan') . '/' . $koperasiKecamatan->file);
            }

            $koperasiKecamatan->delete();
            return redirect('/adminkoperasikecamatan')->with('success', 'Kecamatan Berhasil Dihapus!');
        } catch (\Exception $e) {
            return redirect('/adminkoperasikecamatan')->with('error', 'Terjadi kesalahan saat menghapus kecamatan. Silakan coba lagi.');
        }
    }
}
