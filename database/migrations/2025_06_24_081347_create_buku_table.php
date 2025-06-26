<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
                  $table->unsignedBigInteger('kategori_buku_id');
              $table->string('judul_buku');
              $table->string('pengarang');
              $table->string('penerbit');
              $table->year('tahun_terbit');
              $table->text('deskripsi')->nullable();
              $table->string('foto_sampul',100)->nullable();
              $table->integer('jumlah_eksemplar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
