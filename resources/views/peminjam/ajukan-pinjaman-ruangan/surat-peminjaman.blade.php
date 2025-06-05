<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Surat Peminjaman Barang</title>
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
    <p class="judul">Surat Peminjaman Barang</p>

    <p>Dengan ini, kami menyatakan bahwa:</p>
    <ul>
        <li><strong>Nama Peminjam:</strong> {{ $peminjaman->user->name ?? $peminjaman->user->username }}</li>
        <li><strong>Nama Barang:</strong> {{ $peminjaman->barang->nama_barang ?? '-' }}</li>
        <li><strong>Jumlah:</strong> {{ $peminjaman->jumlah }}</li>
        <li><strong>Kegiatan:</strong> {{ $peminjaman->kegiatan }}</li>
        <li><strong>Tanggal Pinjam:</strong> {{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d-m-Y') }}</li>
        <li><strong>Tanggal Kembali:</strong> {{ \Carbon\Carbon::parse($peminjaman->tgl_kembali)->format('d-m-Y') }}
        </li>
    </ul>

    <p>Demikian surat ini dibuat sebagai bukti pengajuan peminjaman.</p>

    <p>Tanggal Cetak: {{ \Carbon\Carbon::parse($peminjaman->tgl_cetak_surat)->format('d-m-Y') }}</p>
</body>

</html>
