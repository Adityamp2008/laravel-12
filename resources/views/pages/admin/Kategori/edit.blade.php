@extends('layouts.app')
@section('title', 'Ubah Kategori')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kelola Kategori</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dasbor</a></li>
                        <li class="breadcrumb-item active">Ubah Kategori</li>
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
                        <h5 class="card-title">Ubah Kategori</h5>
                        <span class="float-right">
                            <a href="{{ route('Kategori.index') }}" class="btn btn-danger">Kembali</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Kategori.update', $kategori->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                        
                               
                              
                             
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">nama_kategori</label>
                                        <input type="text" name="nama_kategori" value="{{ old('nama_kategori') ?? $kategori->nama_kategori }}"
                                            class="form-control @error('nama_kategori') is-invalid @enderror">
                                        @error('nama_kategori')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
    <!-- /.content -->
@endsection
