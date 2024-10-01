<?php

namespace App\Http\Controllers\koperasi;

use App\Http\Controllers\Controller;
use App\Models\Pengawasan;
use Illuminate\Http\Request;
use App\Models\FotoPengawasan;
use Illuminate\Support\Facades\Storage;

class AdminPengawasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

        return view('admin.koperasi.pengawasan.index', compact('pengawasans'));
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
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'tanggal' => 'required|date',
                'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $pengawasans = Pengawasan::create($request->only('title', 'description', 'tanggal'));

            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $photo) {
                    $path = $photo->store('fotos', 'public');
                    $pengawasans->fotos()->create(['foto' => $path]);
                }
            }

            return redirect()->back()->with('success', 'Pengawasan Berhasil di Tambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan pengawasan. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengawasan $pengawasan)
    {
        return view('admin.koperasi.pengawasan.detail', compact('pengawasan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengawasan $pengawasan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengawasan $pengawasan)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'tanggal' => 'required|date',
                'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Update pengawasan data
            $pengawasan->update($request->only('title', 'description', 'tanggal'));

            // Menghapus foto yang dipilih
            if ($request->has('remove_fotos')) {
                foreach ($request->remove_fotos as $fotoId) {
                    $foto = FotoPengawasan::findOrFail($fotoId);
                    Storage::delete('public/' . $foto->foto); // Menghapus file dari storage
                    $foto->delete(); // Menghapus data dari database
                }
            }

            // Menambahkan foto baru jika ada
            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $photo) {
                    $path = $photo->store('fotos', 'public');
                    $pengawasan->fotos()->create(['foto' => $path]);
                }
            }

            return redirect()->back()->with('success', 'Pengawasan Berhasil di Perbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui pengawasan. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengawasan $pengawasan)
    {
        try {
            foreach ($pengawasan->fotos as $foto) {
                Storage::disk('public')->delete($foto->foto);
                $foto->delete();
            }
            $pengawasan->delete();

            return redirect('/adminpengawasan')->with('success', 'Pengawasan Berhasil di Hapus');
        } catch (\Exception $e) {
            return redirect('/adminpengawasan')->with('error', 'Terjadi kesalahan saat menghapus pengawasan. Silakan coba lagi.');
        }
    }
}
