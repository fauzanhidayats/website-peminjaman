<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Peminjaman Kendaraan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .judul {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        li {
            margin-bottom: 8px;
        }

        .footer {
            margin-top: 50px;
        }

        .ttd {
            float: right;
            text-align: center;
        }
    </style>
</head>

<body>
    <p class="judul">Surat Peminjaman Kendaraan</p>

    <p>Dengan ini kami menyatakan bahwa peminjaman kendaraan telah diajukan dengan rincian sebagai berikut:</p>

    <ul>
        <li><strong>Nama Peminjam:</strong> {{ $peminjaman->user->name ?? $peminjaman->user->username }}</li>
        <li><strong>Nama Kendaraan:</strong> {{ $peminjaman->kendaraan->nama_kendaraan ?? '-' }}</li>
        <li><strong>Keperluan:</strong> {{ $peminjaman->keperluan ?? '-' }}</li>
        <li><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($peminjaman->tgl_mulai)->format('d-m-Y') }}</li>
        <li><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($peminjaman->tgl_selesai)->format('d-m-Y') }}
        </li>
        <li><strong>Status:</strong> {{ ucfirst($peminjaman->status) }}</li>
    </ul>

    <p>Demikian surat ini dibuat untuk digunakan sebagaimana mestinya.</p>

    <div class="footer">
        <div class="ttd">
            <p>Admin</p>
            <br><br>
            <p>______________________</p>
        </div>
    </div>

    <p style="margin-top: 100px;">Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
</body>

</html>
