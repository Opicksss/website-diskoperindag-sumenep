<?php

namespace App\Http\Controllers\koperasi;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\FotoFasilitas;
use Illuminate\Support\Str;

class AdminFasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

        return view('admin.koperasi.fasilitas.index', compact('fasilitass'));
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

            $fasilitass = Fasilitas::create($request->only('title', 'description', 'tanggal'));

            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $photo) {
                    $path = $photo->store('fotos', 'public');
                    $fasilitass->fotos()->create(['foto' => $path]);
                }
            }

            return redirect()->back()->with('success', 'Fasilitas Berhasil di Tambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan fasilitas. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Fasilitas $fasilitas)
    {
        return view('admin.koperasi.fasilitas.detail', compact('fasilitas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fasilitas $fasilitas)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fasilitas $fasilitas)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'tanggal' => 'required|date',
                'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Update fasilitas data
            $fasilitas->update($request->only('title', 'description', 'tanggal'));

            // Menghapus foto yang dipilih
            if ($request->has('remove_fotos')) {
                foreach ($request->remove_fotos as $fotoId) {
                    $foto = FotoFasilitas::findOrFail($fotoId);
                    Storage::delete('public/' . $foto->foto); // Menghapus file dari storage
                    $foto->delete(); // Menghapus data dari database
                }
            }

            // Menambahkan foto baru jika ada
            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $photo) {
                    $path = $photo->store('fotos', 'public');
                    $fasilitas->fotos()->create(['foto' => $path]);
                }
            }

            return redirect()->back()->with('success', 'Fasilitas Berhasil di Perbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui fasilitas. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fasilitas $fasilitas)
    {
        try {
            foreach ($fasilitas->fotos as $foto) {
                // Menghapus file dari storage
                Storage::disk('public')->delete($foto->foto);
                // Menghapus data dari database
                $foto->delete();
            }
            // Menghapus fasilitas
            $fasilitas->delete();

            return redirect('/adminfasilitas')->with('success', 'Fasilitas Berhasil di Hapus');
        } catch (\Exception $e) {
            return redirect('/adminfasilitas')->with('error', 'Terjadi kesalahan saat menghapus fasilitas. Silakan coba lagi.');
        }
    }
}
