<?php

namespace App\Http\Controllers\koperasi;

use App\Http\Controllers\Controller;
use App\Models\CategoryKelompok;
use Illuminate\Http\Request;

class CategoryKelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->Search;
        $categoriess = CategoryKelompok::withCount([
            'kelompoks as total' => function ($query) {
                $query->where('keterangan', '!=', '');
            },
            'kelompoks as aktif' => function ($query) {
                $query->where('keterangan', 'aktif');
            },
            'kelompoks as tidak_aktif' => function ($query) {
                $query->where('keterangan', 'tidak aktif');
            },
        ])
            ->where(function ($query) use ($search) {
                $query->where('category_kelompoks.nama', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('category_kelompoks.created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        return view('admin.koperasi.kelompok.category', compact('categoriess'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
            ]);

            CategoryKelompok::create($validatedData);
            return redirect()->back()->with('success', 'Kelompok Berhasil di Tambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan kelompok. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryKelompok $categoryKelompok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryKelompok $categoryKelompok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryKelompok $categoryKelompok)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
            ]);

            $categoryKelompok->update($validatedData);
            return redirect()->back()->with('success', 'Kelompok Berhasil di Perbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui kelompok. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryKelompok $categoryKelompok)
    {
        try {
            $categoryKelompok->delete();
            return redirect('/categorykelompok')->with('success', 'Kelompok Berhasil Dihapus!');
        } catch (\Exception $e) {
            return redirect('/categorykelompok')->with('error', 'Terjadi kesalahan saat menghapus kelompok. Silakan coba lagi.');
        }
    }
}
