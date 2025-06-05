<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Peminjaman Barang</title>
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
    <p class="judul">Surat Peminjaman Barang</p>

    <p>Dengan ini kami menyatakan bahwa peminjaman barang telah diajukan dengan rincian sebagai berikut:</p>

    <ul>
        <li><strong>Nama Peminjam:</strong> {{ $peminjaman->user->name ?? $peminjaman->user->username }}</li>
        <li><strong>Nama Barang:</strong> {{ $peminjaman->barang->nama_barang ?? '-' }}</li>
        <li><strong>Jumlah:</strong> {{ $peminjaman->jumlah }}</li>
        <li><strong>Kegiatan:</strong> {{ $peminjaman->kegiatan ?? '-' }}</li>
        <li><strong>Tanggal Peminjaman:</strong> {{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d-m-Y') }}
        </li>
        <li><strong>Tanggal Pengembalian:</strong>
            {{ \Carbon\Carbon::parse($peminjaman->tgl_kembali)->format('d-m-Y') }}</li>
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
