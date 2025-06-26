<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
     protected $table = 'peminjaman';
    protected $fillable = [
        'buku_id',
        'anggota_id',
        'tgl_pinjam',
        'tgl_wajib_kembali',
        'tgl_pengembalian',
        'denda',
        'status'
    ];

      public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
