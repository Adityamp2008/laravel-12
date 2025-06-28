<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class LaporanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with(['anggota', 'buku'])->get();
foreach ($data as $row) {
    $due = Carbon::parse($row->tgl_kembali)->startOfDay();
    $returned = $row->tgl_pengembalian
        ? Carbon::parse($row->tgl_pengembalian)->startOfDay()
        : Carbon::now()->startOfDay();

    // Itungan selisih bener: dari due (tgl kembali seharusna) ke returned (tgl balikin)
    $daysLate = $due->diffInDays($returned, false);

    $row->terlambat_hari = $daysLate > 0 ? $daysLate : 0;
    $row->denda = $daysLate > 0 ? $daysLate * 1000 : 0;
}

        return view('pages.admin.laporan.peminjaman', compact('data'));
    }

    
      public function exportPdf()
    {
        $data = Peminjaman::with(['anggota', 'buku'])->get();

        foreach ($data as $row) {
            $tglKembali = Carbon::parse($row->tgl_kembali)->startOfDay();
            $tglPengembalian = $row->tgl_pengembalian
                ? Carbon::parse($row->tgl_pengembalian)->startOfDay()
                : Carbon::now()->startOfDay();

            $selisih = $tglPengembalian->diffInDays($tglKembali, false);
            $row->terlambat_hari = $selisih < 0 ? abs($selisih) : 0;
            $row->denda = $row->terlambat_hari * 1000;
        }

        $pdf = Pdf::loadView('pages.admin.laporan.peminjaman_pdf', compact('data'));
        return $pdf->download('laporan-peminjaman.pdf');
    }
}
