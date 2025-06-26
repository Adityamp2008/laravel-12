<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\KelolaAnggotaController;
use App\Http\Controllers\Admin\KategoriBukuController;
use App\Http\Controllers\Admin\KelolaBukuController;
use App\Http\Controllers\Admin\peminjamanController;
use App\Http\Controllers\LoginController;
use App\Models\KategoriBuku;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'formLogin']);
Route::post('/login', [LoginController::class, 'loginAction'])->name('login.action');

Route::group(['admin'], function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // route magic/resource laravel for crud
    Route::resource('anggota', KelolaAnggotaController::class);
    Route::resource('Kategori', KategoriBukuController::class);
    Route::resource('buku', KelolaBukuController::class);
    Route::resource('peminjaman', peminjamanController::class);
    // Route::resource('laporan', KategoriBukuController::class);
   

    // cara manuak satu-satu
    // Route::get('/kelola-anggota', [KelolaAnggotaController::class, 'index'])->name('anggota.index');
    // Route::get('/kelola-anggota/create', [KelolaAnggotaController::class, 'create'])->name('anggota.create');
    // Route::post('/kelola-anggota', [KelolaAnggotaController::class, 'store'])->name('anggota.store');
    // Route::get('/kelola-anggota/edit/{id}', [KelolaAnggotaController::class, 'edit'])->name('anggota.edit');
    // Route::patch('/kelola-anggota/update/{id}', [KelolaAnggotaController::class, 'update'])->name('anggota.update');
    // Route::delete('/kelola-anggota/{id}', [KelolaAnggotaController::class, 'destroy'])->name('anggota.destroy');
})->middleware('auth');
