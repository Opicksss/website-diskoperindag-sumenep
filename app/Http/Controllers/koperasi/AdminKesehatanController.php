<?php

namespace App\Http\Controllers\koperasi;

use App\Http\Controllers\Controller;
use App\Models\Kesehatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\FotoKesehatan;
use Illuminate\Support\Str;

class AdminKesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

        return view('admin.koperasi.kesehatan.index', compact('kesehatans'));
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

            $kesehatans = Kesehatan::create($request->only('title', 'description', 'tanggal'));

            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $photo) {
                    $path = $photo->store('fotos', 'public');
                    $kesehatans->fotos()->create(['foto' => $path]);
                }
            }

            return redirect()->back()->with('success', 'Kesehatan Berhasil di Tambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan kesehatan. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kesehatan $kesehatan)
    {
        return view('admin.koperasi.kesehatan.detail', compact('kesehatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kesehatan $kesehatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kesehatan $kesehatan)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'tanggal' => 'required|date',
                'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Update kesehatan data
            $kesehatan->update($request->only('title', 'description', 'tanggal'));

            // Menghapus foto yang dipilih
            if ($request->has('remove_fotos')) {
                foreach ($request->remove_fotos as $fotoId) {
                    $foto = FotoKesehatan::findOrFail($fotoId);
                    Storage::delete('public/' . $foto->foto); // Menghapus file dari storage
                    $foto->delete(); // Menghapus data dari database
                }
            }

            // Menambahkan foto baru jika ada
            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $photo) {
                    $path = $photo->store('fotos', 'public');
                    $kesehatan->fotos()->create(['foto' => $path]);
                }
            }

            return redirect()->back()->with('success', 'Kesehatan Berhasil di Perbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui kesehatan. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kesehatan $kesehatan)
    {
        try {
            foreach ($kesehatan->fotos as $foto) {
                Storage::disk('public')->delete($foto->foto);
                $foto->delete();
            }
            $kesehatan->delete();

            return redirect('/adminkesehatan')->with('success', 'Kesehatan Berhasil di Hapus');
        } catch (\Exception $e) {
            return redirect('/adminkesehatan')->with('error', 'Terjadi kesalahan saat menghapus kesehatan. Silakan coba lagi.');
        }
    }
}
