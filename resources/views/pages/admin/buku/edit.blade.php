@extends('layouts.app')
@section('title', 'Ubah Buku')
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
                        <li class="breadcrumb-item active">Ubah Buku</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Ubah Buku</h5>
                        <span class="float-right">
                            <a href="{{ route('buku.index') }}" class="btn btn-danger">Kembali</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('buku.update', $buku->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <!-- Judul Buku -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="judul_buku" class="form-label">Judul Buku</label>
                                        <input type="text" name="judul_buku" id="judul_buku" 
                                            value="{{ old('judul_buku', $buku->judul_buku) }}" 
                                            class="form-control @error('judul_buku') is-invalid @enderror">
                                        @error('judul_buku')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Pengarang -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pengarang" class="form-label">Pengarang</label>
                                        <input type="text" name="pengarang" id="pengarang" 
                                            value="{{ old('pengarang', $buku->pengarang) }}" 
                                            class="form-control @error('pengarang') is-invalid @enderror">
                                        @error('pengarang')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Penerbit -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="penerbit" class="form-label">Penerbit</label>
                                        <input type="text" name="penerbit" id="penerbit" 
                                            value="{{ old('penerbit', $buku->penerbit) }}" 
                                            class="form-control @error('penerbit') is-invalid @enderror">
                                        @error('penerbit')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tahun Terbit -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                                        <input type="number" name="tahun_terbit" id="tahun_terbit" 
                                            value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" 
                                            class="form-control @error('tahun_terbit') is-invalid @enderror" min="1000" max="9999">
                                        @error('tahun_terbit')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Jumlah Eksemplar -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jumlah_eksemplar" class="form-label">Jumlah Eksemplar</label>
                                        <input type="number" name="jumlah_eksemplar" id="jumlah_eksemplar" 
                                            value="{{ old('jumlah_eksemplar', $buku->jumlah_eksemplar) }}" 
                                            class="form-control @error('jumlah_eksemplar') is-invalid @enderror" min="1">
                                        @error('jumlah_eksemplar')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Kategori Buku -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kategori_buku_id" class="form-label">Kategori Buku</label>
                                        <select name="kategori_buku_id" id="kategori_buku_id" 
                                            class="form-control @error('kategori_buku_id') is-invalid @enderror">
                                            <option value="" disabled>Pilih Kategori</option>
                                            @foreach ($kategori as $kat)
                                                <option value="{{ $kat->id }}" 
                                                    {{ (old('kategori_buku_id', $buku->kategori_buku_id) == $kat->id) ? 'selected' : '' }}>
                                                    {{ $kat->nama_kategori ?? $kat->kategori }} {{-- sesuaikan field kategori --}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kategori_buku_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Deskripsi -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <input type="text" name="deskripsi" id="deskripsi" value="{{ old('deskripsi', $buku->deskripsi) }}" 
                                            class="form-control @error('deskripsi') is-invalid @enderror">   </input>
                                        @error('deskripsi')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Foto Sampul -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="foto_sampul" class="form-label">Foto Sampul</label>
                                        <input type="file" name="foto_sampul" id="foto_sampul" 
                                            class="form-control @error('foto_sampul') is-invalid @enderror">
                                        @error('foto_sampul')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    @if ($buku->foto_sampul)
                                        <img src="{{ asset('storage/' . $buku->foto_sampul) }}" class="img-fluid" alt="Foto Sampul">
                                    @else
                                        <p>Tidak ada foto sampul</p>
                                    @endif
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
