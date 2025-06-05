<?php

namespace App\Http\Controllers\Peminjam;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LihatBarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::latest()->get();
        return view('peminjam.lihat-barang.index', compact('barangs'));
    }
}
