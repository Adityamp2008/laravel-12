@extends('layouts.app')
@section('title', 'Data Peminjaman')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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
                    <li class="breadcrumb-item active">Peminjaman</li>
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
                    <h5 class="card-title">Data Peminjaman</h5>
                    <span class="float-right">
                        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">Tambah</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('components.alert')
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Buku</th>
                                    <th>Anggota</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Tgl Kembali</th>
                                    <th>Tgl Pengembalian</th>
                                    <th>Denda</th>
                                    <th>Status</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $peminjaman)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $peminjaman->buku->judul_buku ?? '-' }}</td>
                                        <td>{{ $peminjaman->anggota->nama ?? '-' }}</td>
                                        <td>{{ $peminjaman->tgl_pinjam }}</td>
                                        <td>{{ $peminjaman->tgl_wajib_kembali }}</td>
                                        <td>{{ $peminjaman->tgl_pengembalian ?? '-' }}</td>
                                        <td>{{ $peminjaman->denda }}</td>
                                        <td>
                                            <span class="badge badge-{{ $peminjaman->status === 'dipinjam' ? 'warning' : 'success' }}">
                                                {{ ucfirst($peminjaman->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('peminjaman.edit', $peminjaman->id) }}" class="btn btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" data-href="{{ route('peminjaman.destroy', $peminjaman->id) }}"
                                                class="btn btn-danger text-white btn-hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($data->isEmpty())
                                    <tr>
                                        <td colspan="9" class="text-center">Belum ada data peminjaman.</td>
                                    </tr>
                                @endif
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
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
    integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('.btn-hapus').click(function () {
            const conf = confirm('Apakah yakin akan dihapus?');
            if (conf) {
                const url = $(this).data('href');
                $('#formDelete').attr('action', url);
                $('#formDelete').submit();
            }
        });
    });
</script>
@endsection