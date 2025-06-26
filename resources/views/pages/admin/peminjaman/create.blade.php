@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Kelola Peminjaman</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dasbor</a></li>
                    <li class="breadcrumb-item active">Tambah Peminjaman</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form Tambah Peminjaman</h5>
                    <span class="float-right">
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-danger">Kembali</a>
                    </span>
                </div>
                <div class="card-body">
                    <form action="{{ route('peminjaman.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Buku -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Buku</label>
                                    <select name="buku_id" class="form-control @error('buku_id') is-invalid @enderror">
                                        <option value="">-- Pilih Buku --</option>
                                        @foreach($buku as $item)
                                            <option value="{{ $item->id }}" {{ old('buku_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->judul_buku }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('buku_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Anggota -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Anggota</label>
                                    <select name="anggota_id" class="form-control @error('anggota_id') is-invalid @enderror">
                                        <option value="">-- Pilih Anggota --</option>
                                        @foreach($anggota as $item)
                                            <option value="{{ $item->id }}" {{ old('anggota_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('anggota_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tgl Pinjam -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Pinjam</label>
                                    <input type="date" name="tgl_pinjam" value="{{ old('tgl_pinjam') }}" class="form-control @error('tgl_pinjam') is-invalid @enderror">
                                    @error('tgl_pinjam')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tgl Wajib Kembali -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Wajib Kembali</label>
                                    <input type="date" name="tgl_wajib_kembali" value="{{ old('tgl_wajib_kembali') }}" class="form-control @error('tgl_wajib_kembali') is-invalid @enderror">
                                    @error('tgl_wajib_kembali')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="dipinjam" {{ old('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                        <option value="dikembalikan" {{ old('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col -->
    </div> <!-- /.row -->
</section>
@endsection
