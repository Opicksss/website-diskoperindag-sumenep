<?php

namespace App\Http\Controllers\koperasi;

use App\Http\Controllers\Controller;
use App\Models\CategoryKecamatan;
use Illuminate\Http\Request;
use App\Models\Kecamatan;

class CategoryKecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $search = $request->Search;
        $categoriess = CategoryKecamatan::withCount([
            'kecamatans as total' => function ($query) {
                $query->where('keterangan', '!=', '');
            },
            'kecamatans as aktif' => function ($query) {
                $query->where('keterangan', 'aktif');
            },
            'kecamatans as tidak_aktif' => function ($query) {
                $query->where('keterangan', 'tidak aktif');
            },
        ])
            ->where(function ($query) use ($search) {
                $query->where('category_kecamatans.nama', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('category_kecamatans.created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        return view('admin.koperasi.kecamatan.category', compact('categoriess'));
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
            ]);

            CategoryKecamatan::create($validatedData);
            return redirect()->back()->with('success', 'Kecamatan Berhasil di Tambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan kecamatan. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryKecamatan $categoryKecamatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryKecamatan $categoryKecamatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryKecamatan $categoryKecamatan)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
            ]);

            $categoryKecamatan->update($validatedData);
            return redirect()->back()->with('success', 'Kecamatan Berhasil di Perbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui kecamatan. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryKecamatan $categoryKecamatan)
    {
        try {
            $categoryKecamatan->delete();
            return redirect('/categorykecamatan')->with('success', 'Kecamatan Berhasil Dihapus!');
        } catch (\Exception $e) {
            return redirect('/categorykecamatan')->with('error', 'Terjadi kesalahan saat menghapus kecamatan. Silakan coba lagi.');
        }
    }
}
