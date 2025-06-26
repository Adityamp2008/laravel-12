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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
              $table->foreignId('buku_id')->constrained('buku')->onDelete('cascade');
              $table->foreignId('anggota_id')->constrained('anggota')->onDelete('cascade');
              $table->dateTime('tgl_pinjam');
              $table->dateTime('tgl_wajib_kembali');
              $table->dateTime('tgl_pengembalian')->nullable(); // boleh null
              $table->integer('denda')->default(0);
              $table->string('status', 20); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
