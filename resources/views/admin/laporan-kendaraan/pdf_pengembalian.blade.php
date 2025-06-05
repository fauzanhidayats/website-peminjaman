<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pengembalian</title>
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
    <h2>Laporan Pengembalian Barang</h2>
    <p>Periode: {{ $tanggal_mulai }} s/d {{ $tanggal_selesai }}</p>

    <table>
        <thead>
            <tr>
                <th>Nama Peminjam</th>
                <th>Kendaraan</th>
                <th>Tanggal Dikembalikan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengembalian as $item)
                <tr>
                    <td>{{ $item->peminjamanKendaraan->user->username ?? '-' }}</td>
                    <td>{{ $item->peminjamanKendaraan->kendaraan->nama_kendaraan ?? '-' }}</td>
                    <td>{{ $item->tgl_dikembalikan }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data pengembalian pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
