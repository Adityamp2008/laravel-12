<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'judul_buku',
        'tahun_terbit',
        'jumlah_eksemplar',
        'deskripsi',
        'kategori_buku_id',
        'foto_sampul',
        'pengarang',
        'penerbit',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBuku::class, 'kategori_buku_id');
    }
    public function peminjaman()
{
    return $this->hasMany(Peminjaman::class);
}

        public function kategoriList()
        {
            return $this->belongsTo(KategoriBuku::class, 'kategori_buku_id');
        }     
   
}
