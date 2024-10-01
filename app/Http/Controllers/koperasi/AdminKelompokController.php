<?php

namespace App\Http\Controllers\koperasi;

use App\Models\Kelompok;
use Illuminate\Http\Request;
use App\Models\CategoryKelompok;
use App\Http\Controllers\Controller;

class AdminKelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $category_id)
    {
        $search = $request->Search;
        $category = CategoryKelompok::findOrFail($category_id);

        $kelompoks = Kelompok::query()
            ->where('category_id', $category->id)
            ->where(function ($query) use ($search) {
                $query
                    ->where('nama', 'LIKE', '%' . $search . '%')
                    ->orWhere('ketua', 'LIKE', '%' . $search . '%')
                    ->orWhere('nik', 'LIKE', '%' . $search . '%')
                    ->orWhere('nomor', 'LIKE', '%' . $search . '%')
                    ->orWhere('tanggal', 'LIKE', '%' . $search . '%')
                    ->orWhere('alamat', 'LIKE', '%' . $search . '%')
                    ->orWhere('desa', 'LIKE', '%' . $search . '%')
                    ->orWhere('rat', 'LIKE', '%' . $search . '%')
                    ->orWhere('aset', 'LIKE', '%' . $search . '%')
                    ->orWhere('volume', 'LIKE', '%' . $search . '%')
                    ->orWhere('shu', 'LIKE', '%' . $search . '%')
                    ->orWhere('keterangan', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        return view('admin.koperasi.kelompok.kelompok', compact('category', 'kelompoks'));
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
                'ketua' => 'required|string|max:255',
                'nik' => 'required|string|max:255',
                'nomor' => 'required|string|max:255',
                'tanggal' => 'required|date',
                'alamat' => 'required|string|max:255',
                'desa' => 'required|string|max:255',
                'rat' => 'required|date',
                'aset' => 'required|integer',
                'volume' => 'required|integer',
                'shu' => 'required|integer',
                'keterangan' => 'required|in:aktif,tidak aktif',
                'category_id' => 'required',
            ]);

            Kelompok::create($validatedData);
            return redirect()->back()->with('success', 'Koperasi Berhasil di Tambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan koperasi. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelompok $kelompok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelompok $kelompok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelompok $kelompok)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'ketua' => 'required|string|max:255',
                'nik' => 'required|string|max:255',
                'nomor' => 'required|string|max:255',
                'tanggal' => 'required|date',
                'alamat' => 'required|string|max:255',
                'desa' => 'required|string|max:255',
                'rat' => 'required|date',
                'aset' => 'required|integer',
                'volume' => 'required|integer',
                'shu' => 'required|integer',
                'keterangan' => 'required|in:aktif,tidak aktif',
                'category_id' => 'required',
            ]);
            // dd($kelompok);
            $kelompok->update($validatedData);
            return redirect()->back()->with('success', 'Koperasi Berhasil di Perbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui koperasi. Silakan coba lagi.');
        }
    }

    public function keterangan(Request $request, Kelompok $kelompok)
    {
        try {
            // Validasi hanya untuk field 'keterangan'
            $validatedData = $request->validate([
                'keterangan' => 'required|in:aktif,tidak aktif',
            ]);

            // Perbarui keterangan
            $kelompok->update($validatedData);

            $message = $validatedData['keterangan'] === 'aktif'
            ? 'Status keterangan Koperasi berhasil Diaktifkan.'
            : 'Status keterangan Koperasi berhasil Dinonaktifkan.';

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui status keterangan. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelompok $kelompok)
    {
        try {
            $kelompok->delete();
            return redirect()->back()->with('success', 'Koperasi Berhasil Dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus koperasi. Silakan coba lagi.');
        }
    }
}
