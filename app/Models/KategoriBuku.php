<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{

    protected $table = 'kategori_buku';

    protected $fillable = [
        'id',
        'nama_kategori'
    ];


    public function buku()
{
    return $this->hasMany(Buku::class, 'kategori_buku_id');
}
}
