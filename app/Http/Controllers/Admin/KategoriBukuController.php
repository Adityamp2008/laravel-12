<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\KategoriBuku;
use App\Models\KategoriBuku as ModelsKategoriBuku;
use Illuminate\Http\Request;

class KategoriBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         
        try {
            // Ambil kolom id dan nama_kategori
            $data = ModelsKategoriBuku::select('id', 'nama_kategori')->get();

            // Kirim data ke view
            return view('pages.admin.kategori.index', compact('data'));
        } catch (\Throwable $th) {
            throw $th;
        }
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('pages.admin.Kategori.create');
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
        'nama_kategori' => 'required|string|max:50',
    ]);

    try {
        // Simpan ke database
        ModelsKategoriBuku::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('Kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    } catch (\Throwable $th) {
        return redirect()->route('Kategori.index')->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
          $kategori = ModelsKategoriBuku::findOrFail($id);
    return view('pages.admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $request->validate([
        'nama_kategori' => 'required|string|max:50',
    ]);

    try {
        $kategori = ModelsKategoriBuku::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('Kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    } catch (\Throwable $th) {
        return redirect()->route('kategori.index')->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         try {
        $kategori = ModelsKategoriBuku::findOrFail($id);
        $kategori->delete();

        return redirect()->route('Kategori.index')->with('success', 'Kategori berhasil dihapus!');
    } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'Gagal menghapus kategori: ' . $th->getMessage());
    }
    }
}
