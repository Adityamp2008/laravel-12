<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #eee; }
        h2 { text-align: center; margin-bottom: 0; }
        p { text-align: center; margin-top: 5px; }
    </style>
</head>
<body>
    <h2>Laporan Peminjaman Buku</h2>
    <p>Perpustakaan smk nurul islam </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Terlambat</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $peminjaman)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $peminjaman->anggota->nama ?? '-' }}</td>
                <td>{{ $peminjaman->buku->judul_buku ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_wajib_kembali)->format('d-m-Y') }}</td>
                <td>
                    {{ $peminjaman->tgl_pengembalian ? 'Dikembalikan' : 'Belum' }}
                </td>
                <td>{{ $peminjaman->terlambat_hari }} hari</td>
                <td>Rp{{ number_format($peminjaman->denda, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
