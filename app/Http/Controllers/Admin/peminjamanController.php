<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;

class peminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $data = Peminjaman::with(['buku', 'anggota'])->get();
        return view('pages.admin.peminjaman.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $buku = Buku::all();
         $anggota = Anggota::all();
        return view('pages.admin.peminjaman.create', compact('buku', 'anggota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'anggota_id' => 'required|exists:anggota,id',
            'tgl_pinjam' => 'required|date',
            'tgl_wajib_kembali' => 'required|date|after_or_equal:tgl_pinjam',
            'status' => 'required|string|max:20',
        ]);
          Peminjaman::create([
            'buku_id' => $request->buku_id,
            'anggota_id' => $request->anggota_id,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_wajib_kembali' => $request->tgl_wajib_kembali,
            'tgl_pengembalian' => $request->tgl_pengembalian,
            'denda' => $request->denda ?? 0,
            'status' => $request->status,
        ]);

           return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan.');
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
          $peminjaman = Peminjaman::findOrFail($id);
        $buku = Buku::all();
        $anggota = Anggota::all();
        return view('pages.admin.peminjaman.edit', compact('peminjaman', 'buku', 'anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'anggota_id' => 'required|exists:anggota,id',
            'tgl_pinjam' => 'required|date',
            'tgl_pengembalian' => 'nullable|date',
            'tgl_wajib_kembali' => 'required|date|after_or_equal:tgl_pinjam',
            'status' => 'required|string|max:20',
        ]);

         $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'buku_id' => $request->buku_id,
            'anggota_id' => $request->anggota_id,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_wajib_kembali' => $request->tgl_wajib_kembali,
            'tgl_pengembalian' => $request->tgl_pengembalian,
            'denda' => $request->denda ?? 0,
            'status' => $request->status,
        ]);
         $peminjaman->save();

          return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman dihapus.');
    }
}
