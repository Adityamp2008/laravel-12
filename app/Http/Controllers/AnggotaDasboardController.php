<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class AnggotaDasboardController extends Controller
{
    //
    public function index(Request $request)
{
    $query = Buku::with('kategoriList');

    if ($request->has('search') && $request->search != '') {
        $query->where('judul_buku', 'like', '%' . $request->search . '%');
    }

    $data = $query->paginate(10)->appends(['search' => $request->search]);

    return view('pages.anggota.dasboard', compact('data'));
}
}
