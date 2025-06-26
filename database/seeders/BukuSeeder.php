<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
 public function run()
{
    \App\Models\Buku::create([
        'judul' => 'Laravel untuk Pemula',
        'tahun_terbit' => 2023,
        'jumlah_eksemplar' => 10,
        'kategori_buku_id' => 1,
        'deskripsi' => 'Buku panduan belajar Laravel.'
    ]);
}
}
