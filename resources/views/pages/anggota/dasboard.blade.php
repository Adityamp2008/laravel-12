@extends('layouts.anggota')
@section('title', 'Dashboard')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dasbor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dasbor</li>
                    </ol>
                </div>
            </div>
        </div>
         <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
          
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">usr : {{ auth()->user()->username }}</span>
                        <span class="info-box-number">nama : {{ auth()->user()->nama }}</span>
                        <span class="info-box-number">Role :
                          {{ auth()->user()->peran }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Data buku yang dapat di pinjam</h5>
                        <span class="float-right">
                            {{-- nyari one piace --}}
                             <form method="GET" action="{{ route('anggota.dashboard') }}">
                            <div class="input-group input-group-sm mb-3" style="width: 300px;">
                                <input name="search" class="form-control form-control-navbar" type="search" placeholder="Cari buku..." aria-label="Search" value="{{ request('search') }}">
                                <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                </div>
                            </div>
                            </form>
                        {{-- akhir one piace --}}
                        </span>
                    </div>
                    <div class="card-body">
                        @include('components.alert')
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>judul buku</th>
                                        <th>kategori</th>
                                        <th>pengarang</th>
                                        <th>penerbit</th>
                                        <th>tahun terbit</th>
                                        <th>jumlah</th>
                                        <th>deskripsi</th>
                                        <th>sampul</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach ($data as $buku)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $buku->judul_buku }}</td>
                                    <td>{{ $buku->kategori->nama_kategori ?? '-' }}</td>
                                    <td>{{ $buku->pengarang }}</td>
                                    <td>{{ $buku->penerbit }}</td>
                                    <td>Thn {{ $buku->tahun_terbit }}</td>
                                    <td>{{ $buku->jumlah_eksemplar }}</td>
                                    <td>{{ $buku->deskripsi }}</td>
                                      <td>
                                        <img src="{{ asset('storage/' . $buku->foto_sampul) }}" width="50" alt="Foto Sampul">
                                    </td>
                                    
                                  
                                </tr>
                            @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="" method="post" id="formDelete">
            @csrf
            @method('delete')
        </form>
    </section>
    
    <!-- /.content -->
@endsection
