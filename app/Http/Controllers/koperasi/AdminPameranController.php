<?php

namespace App\Http\Controllers\koperasi;

use App\Http\Controllers\Controller;
use App\Models\Pameran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\FotoPameran;

class AdminPameranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

        return view('admin.koperasi.pameran.index', compact('pamerans'));
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

            $pamerans = Pameran::create($request->only('title', 'description', 'tanggal'));

            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $photo) {
                    $path = $photo->store('fotos', 'public');
                    $pamerans->fotos()->create(['foto' => $path]);
                }
            }

            return redirect()->back()->with('success', 'Pameran Berhasil di Tambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan pameran. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pameran $pameran)
    {
        return view('admin.koperasi.pameran.detail', compact('pameran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pameran $pameran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pameran $pameran)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'tanggal' => 'required|date',
                'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Update pameran data
            $pameran->update($request->only('title', 'description', 'tanggal'));

            // Menghapus foto yang dipilih
            if ($request->has('remove_fotos')) {
                foreach ($request->remove_fotos as $fotoId) {
                    $foto = FotoPameran::findOrFail($fotoId);
                    Storage::delete('public/' . $foto->foto); // Menghapus file dari storage
                    $foto->delete(); // Menghapus data dari database
                }
            }

            // Menambahkan foto baru jika ada
            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $photo) {
                    $path = $photo->store('fotos', 'public');
                    $pameran->fotos()->create(['foto' => $path]);
                }
            }

            return redirect()->back()->with('success', 'Pameran Berhasil di Perbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui pameran. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pameran $pameran)
    {
        try {
            foreach ($pameran->fotos as $foto) {
                Storage::disk('public')->delete($foto->foto);
                $foto->delete();
            }
            $pameran->delete();

            return redirect('/adminpameran')->with('success', 'Pameran Berhasil di Hapus');
        } catch (\Exception $e) {
            return redirect('/adminpameran')->with('error', 'Terjadi kesalahan saat menghapus pameran. Silakan coba lagi.');
        }
    }
}
