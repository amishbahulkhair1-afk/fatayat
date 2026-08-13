<?php

namespace App\Http\Controllers;

use App\Models\DokumentasiKegiatan;

class DokumentasiPublikController extends Controller
{
    public function index()
    {
        $dokumentasi = DokumentasiKegiatan::where('status', 'Publikasi')->latest('tanggal_kegiatan')->paginate(12);
        return view('publikasi.dokumentasi-index', compact('dokumentasi'));
    }
}