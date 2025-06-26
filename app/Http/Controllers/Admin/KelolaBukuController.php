<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Http\Models\KategoriBuku;
use App\Models\KategoriBuku as ModelsKategoriBuku;

class KelolaBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      try {
            // Ambil kolom id dan nama_kategori
                    $data = Buku::all();

            // Kirim data ke view
            return view('pages.admin.buku.index', compact('data'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
      $kategori = \App\Models\KategoriBuku::all();
      return view('pages.admin.buku.create', compact('kategori'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'judul_buku' => 'required|string|max:255',
        'penerbit' => 'required|string',
        'pengarang' => 'required|string',
        'jumlah_eksemplar' => 'required|integer',
        'kategori_buku_id' => 'required|exists:kategori_buku,id',
        'tahun_terbit' => 'required|digits:4',
        'deskripsi' => 'required|string',
        'foto_sampul' => 'nullable|image|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('foto_sampul')) {
        $data['foto_sampul'] = $request->file('foto_sampul')->store('sampul', 'public');
    }

    Buku::create($data);

    return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
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
    public function edit(string $id)
    {
          $buku = buku::findOrFail($id);
    $kategori = ModelsKategoriBuku::all();

    return view('pages.admin.buku.edit', compact('buku', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
        // Validasi input
        $request->validate([
            'judul_buku' => 'required|string|max:255',
            'penerbit' => 'required|string',
            'pengarang' => 'required|string',
            'jumlah_eksemplar' => 'required|integer',
            'kategori_buku_id' => 'required|exists:kategori_buku,id',
            'tahun_terbit' => 'required|digits:4',
            'deskripsi' => 'required|string',
            'foto_sampul' => 'nullable|image|max:2048',
        ]);

        // Ambil data buku yang mau diupdate
        $buku = buku::findOrFail($id);

        // Simpan path lama foto sampul
        $path = $buku->foto_sampul;

        // Kalau ada upload foto baru, simpan dan update path
        if ($request->hasFile('foto_sampul')) {
            $path = $request->file('foto_sampul')->store('sampul', 'public');
        }

        // Update data buku
        $buku->update([
            'judul_buku' => $request->judul_buku,
            'penerbit' => $request->penerbit,
            'pengarang' => $request->pengarang,
            'jumlah_eksemplar' => $request->jumlah_eksemplar,
            'kategori_buku_id' => $request->kategori_buku_id,
            'tahun_terbit' => $request->tahun_terbit,
            'deskripsi' => $request->deskripsi,
            'foto_sampul' => $path,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    } catch (\Throwable $th) {
        // Bisa diubah jadi logging atau handle error lain
        return redirect()->back()->with('error', 'Gagal memperbarui buku: ' . $th->getMessage());
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
           try {
        $data = buku::findOrFail($id);
        $data->delete();

        return redirect()->route('buku.index')->with('success', 'Kategori berhasil dihapus!');
    } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'Gagal menghapus kategori: ' . $th->getMessage());
    }
}
}
