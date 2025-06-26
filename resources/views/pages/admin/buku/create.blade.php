@extends('layouts.app')

@section('title', 'Tambah buku')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kelola Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dasbor</a></li>
                        <li class="breadcrumb-item active">Tambah Buku</li>
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
                        <h5 class="card-title">Data Buku</h5>
                        <span class="float-right">
                            <a href="{{ route('buku.index') }}" class="btn btn-danger">Kembali</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- Judul Buku --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Judul Buku</label>
                                        <input type="text" name="judul_buku" value="{{ old('judul_buku') }}"
                                            class="form-control @error('judul_buku') is-invalid @enderror">
                                        @error('judul_buku')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Penerbit --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Penerbit</label>
                                        <input type="text" name="penerbit" value="{{ old('penerbit') }}"
                                            class="form-control @error('penerbit') is-invalid @enderror">
                                        @error('penerbit')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Pengarang --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Pengarang</label>
                                        <input type="text" name="pengarang" value="{{ old('pengarang') }}"
                                            class="form-control @error('pengarang') is-invalid @enderror">
                                        @error('pengarang')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Jumlah Eksemplar --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Jumlah Eksemplar</label>
                                        <input type="text" name="jumlah_eksemplar" value="{{ old('jumlah_eksemplar') }}"
                                            class="form-control @error('jumlah_eksemplar') is-invalid @enderror">
                                        @error('jumlah_eksemplar')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Kategori --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Kategori</label>
                                        <select class="form-control @error('kategori_buku_id') is-invalid @enderror" name="kategori_buku_id">
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach($kategori as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori_buku_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Tahun Terbit --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Tahun Terbit</label>
                                        <input type="text" name="tahun_terbit" value="{{ old('tahun_terbit') }}"
                                            class="form-control @error('tahun_terbit') is-invalid @enderror">
                                        @error('tahun_terbit')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            

                                {{-- Foto Sampul --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Foto Sampul</label>
                                        <input type="file" name="foto_sampul"
                                            class="form-control @error('foto_sampul') is-invalid @enderror">
                                        @error('foto_sampul')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                                {{-- Deskripsi --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Deskripsi</label>
                                        <input type="text" name="deskripsi" value="{{ old('deskripsi') }}"
                                            class="form-control @error('deskripsi') is-invalid @enderror">
                                        @error('deskripsi')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Tombol Simpan --}}
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
