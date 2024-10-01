<?php

namespace App\Http\Controllers\koperasi;

use App\Http\Controllers\Controller;
use App\Models\Penghargaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\FotoPenghargaan;

class AdminPenghargaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

        return view('admin.koperasi.penghargaan.index', compact('penghargaans'));
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

            $penghargaans = Penghargaan::create($request->only('title', 'description', 'tanggal'));

            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $photo) {
                    $path = $photo->store('fotos', 'public');
                    $penghargaans->fotos()->create(['foto' => $path]);
                }
            }

            return redirect()->back()->with('success', 'Penghargaan Berhasil di Tambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan penghargaan. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Penghargaan $penghargaan)
    {
        return view('admin.koperasi.penghargaan.detail', compact('penghargaan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penghargaan $penghargaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penghargaan $penghargaan)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'tanggal' => 'required|date',
                'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Update penghargaan data
            $penghargaan->update($request->only('title', 'description', 'tanggal'));

            // Menghapus foto yang dipilih
            if ($request->has('remove_fotos')) {
                foreach ($request->remove_fotos as $fotoId) {
                    $foto = FotoPenghargaan::findOrFail($fotoId);
                    Storage::delete('public/' . $foto->foto); // Menghapus file dari storage
                    $foto->delete(); // Menghapus data dari database
                }
            }

            // Menambahkan foto baru jika ada
            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $photo) {
                    $path = $photo->store('fotos', 'public');
                    $penghargaan->fotos()->create(['foto' => $path]);
                }
            }

            return redirect()->back()->with('success', 'Penghargaan Berhasil di Perbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui penghargaan. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penghargaan $penghargaan)
    {
        try {
            foreach ($penghargaan->fotos as $foto) {
                Storage::disk('public')->delete($foto->foto);
                $foto->delete();
            }
            $penghargaan->delete();

            return redirect('/adminpenghargaan')->with('success', 'Penghargaan Berhasil di Hapus');
        } catch (\Exception $e) {
            return redirect('/adminpenghargaan')->with('error', 'Terjadi kesalahan saat menghapus penghargaan. Silakan coba lagi.');
        }
    }
}
