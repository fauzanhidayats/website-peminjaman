<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Surat Peminjaman Kendaraan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            margin: 40px;
        }

        .judul {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .section {
            margin-bottom: 20px;
        }

        ul {
            padding-left: 20px;
        }

        li {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <p class="judul">Surat Peminjaman Kendaraan</p>

    <p>Dengan ini, kami menyatakan bahwa:</p>
    <ul>
        <li><strong>Nama Peminjam:</strong> {{ $peminjaman->user->name ?? $peminjaman->user->username }}</li>
        <li><strong>Nama Kendaraan:</strong> {{ $peminjaman->kendaraan->nama_kendaraan ?? '-' }}</li>
        <li><strong>Keperluan:</strong> {{ $peminjaman->keperluan ?? '-' }}</li>
        <li><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($peminjaman->tgl_mulai)->format('d-m-Y') }}</li>
        <li><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($peminjaman->tgl_selesai)->format('d-m-Y') }}
        </li>
    </ul>

    <p>Demikian surat ini dibuat sebagai bukti pengajuan peminjaman kendaraan.</p>

    <p>Tanggal Cetak: {{ \Carbon\Carbon::parse($peminjaman->tgl_cetak_surat)->format('d-m-Y') }}</p>
</body>

</html>
