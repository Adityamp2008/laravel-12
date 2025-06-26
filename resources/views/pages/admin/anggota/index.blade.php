@extends('layouts.app')
@section('title', 'Data Anggota')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kelola Anggota</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dasbor</a></li>
                        <li class="breadcrumb-item active">Dasbor</li>
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
                        <h5 class="card-title">Data Anggota</h5>
                        <span class="float-right">
                            <a href="{{ route('anggota.create') }}" class="btn btn-primary">Tambah</a>
                        </span>
                    </div>
                    <div class="card-body">
                        @include('components.alert')
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>NIS</th>
                                        <th>Kelas</th>
                                        <th>L/P</th>
                                        <th>No HP</th>
                                        <th>Foto</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($data as $anggota)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $anggota->nama }}</td>
                                            <td>{{ $anggota->nis }}</td>
                                            <td>{{ $anggota->kelas }}</td>
                                            <td>{{ $anggota->jns_kelamin }}</td>
                                            <td>{{ $anggota->no_hp }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $anggota->foto) }}" width="50"
                                                    alt="">
                                            </td>
                                            <td>
                                                <a href="{{ route('anggota.edit', $anggota->id) }}"
                                                    class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                                                <button type="button"
                                                    data-href="{{ route('anggota.destroy', $anggota->id) }}"
                                                    class="btn btn-danger text-white btn-hapus"><i class="bi bi-trash"></i></button>
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
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.btn-hapus').click(function() {
                const conf = confirm('Apakah yakin akan di hapus?');
                if (conf) {
                    const url = $(this).data('href');
                    $('#formDelete').attr('action', url);
                    $('#formDelete').submit();
                }
            })
        });
    </script>
    <!-- /.content -->
@endsection
