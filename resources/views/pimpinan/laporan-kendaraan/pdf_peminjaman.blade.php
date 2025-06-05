<!DOCTYPE html>
<html>

<head>
    <title>Laporan Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
        }

        p {
            margin: 0;
        }
    </style>
</head>

<body>
    <h2>Laporan Peminjaman Barang</h2>
    <p>Periode: {{ $tanggal_mulai }} s/d {{ $tanggal_selesai }}</p>

    <table>
        <thead>
            <tr>
                <th>Nama Peminjam</th>
                <th>Kendaraan</th>
                <th>Keperluan</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjaman as $item)
                <tr>
                    <td>{{ $item->user->username ?? '-' }}</td>
                    <td>{{ $item->kendaraan->nama_kendaraan ?? '-' }}</td>
                    <td>{{ $item->keperluan ?? '-' }}</td>
                    <td>{{ $item->tgl_mulai }}</td>
                    <td>{{ $item->tgl_selesai }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data peminjaman pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
