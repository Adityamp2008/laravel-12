<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KelolaAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Anggota::select([
                'anggota.id',
                'anggota.nis',
                'anggota.nama',
                'anggota.kelas',
                'anggota.jns_kelamin',
                'anggota.no_hp',
                'anggota.foto',
                'u.nama'
            ])->join('users as u', 'anggota.user_id', '=', 'u.id')
                ->where('u.peran', 'Anggota')
                ->get();

            return view('pages.admin.anggota.index', compact('data'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama'          => 'required|string|max:60',
                'nis'           => 'required|unique:anggota,nis',
                'kelas'         => 'required|string|max:20',
                'jns_kelamin'   => 'required|in:L,P',
                'no_hp'         => 'required|max:13',
                'foto'          => 'nullable|file'
            ]);
            $user = User::create([
                'nama'      => $request->nama,
                'username'  => $request->nis,
                'password'  => bcrypt($request->nis),
                'peran'     => 'Anggota'
            ]);

            $path = null;
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('uploads', 'public');
            }
            Anggota::create([
                'user_id' => $user->id,
                'nis' => $request->nis,
                'nama' => $request->nama,
                'kelas' => $request->kelas,
                'jns_kelamin' => $request->jns_kelamin,
                'no_hp' => $request->no_hp,
                'foto' => $path
            ]);

            return redirect()->route('anggota.index')->with('success', 'Data berhasil di simpan');
        } catch (\Throwable $th) {
            throw $th;
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
    public function edit(string $id)
    {
        try {
            $data = Anggota::select([
                'anggota.id',
                'anggota.nis',
                'anggota.nama',
                'anggota.kelas',
                'anggota.jns_kelamin',
                'anggota.no_hp',
                'anggota.foto',
                'u.nama'
            ])->join('users as u', 'anggota.user_id', '=', 'u.id')
                ->where('anggota.id', $id)
                ->first();

            return view('pages.admin.anggota.edit', compact('data'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'nama'          => 'required|string|max:60',
                'nis'           => 'required|unique:anggota,nis,' . $id,
                'kelas'         => 'required|string|max:20',
                'jns_kelamin'   => 'required|in:L,P',
                'no_hp'         => 'required|max:13',
                'foto'          => 'nullable|file'
            ]);
            $data = Anggota::where('id', $id)->firstOrFail();

            User::where('id', $data->user_id)->update([
                'nama' => $request->nama,
                'username' => $request->nis
            ]);

            $path = $data->foto;
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('uploads', 'public');
            }

            $data->update([
                'nis' => $request->nis,
                'kelas' => $request->kelas,
                'jns_kelamin' => $request->jns_kelamin,
                'no_hp' => $request->no_hp,
                'foto' => $path
            ]);

            return redirect()->route('anggota.index')->with('success', 'Data berhasil di perbarui');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Anggota::findOrFail($id);

            $user_id = $data->user_id;

            $data->delete();

            $user = User::find($user_id);

            $user->delete();
 
            return redirect()->route('anggota.index')->with('success', 'Data Berhasil dihapus');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
