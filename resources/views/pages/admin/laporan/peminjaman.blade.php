@extends('layouts.app')
@section('title', 'Laporan Peminjaman')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Laporan Peminjaman</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dasbor</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Peminjaman</h5>
            <a href="{{ route('laporan.peminjaman.pdf') }}" class="btn btn-danger mb-3 float-right" target="_blank">
                     <i class="fas fa-file-pdf"></i> Cetak PDF
            </a> 
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Anggota</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Jumlah Hari</th>
                            <th>Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data peminjaman.</td>
                            </tr>
                        @else
                            @foreach($data as $peminjaman)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $peminjaman->anggota->nama ?? '-' }}</td>
                                    <td>{{ $peminjaman->buku->judul_buku ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_wajib_kembali)->format('d-m-Y') }}</td>
                                    <td>
                                        @if ($peminjaman->tgl_pengembalian)
                                            <span class="badge badge-success">Dikembalikan</span>
                                        @else
                                            <span class="badge badge-warning">Belum Kembali</span>
                                        @endif
                                    </td>
                                    <td>{{ $peminjaman->terlambat_hari ?? 0 }} hari</td>
                                    <td>Rp{{ number_format($peminjaman->denda ?? 0, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
