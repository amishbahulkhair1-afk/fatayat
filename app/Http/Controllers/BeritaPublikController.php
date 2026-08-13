<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class BeritaPublikController extends Controller
{
    public function index()
    {
        $berita = Berita::where('status', 'Publik')->latest('tanggal_kegiatan')->paginate(9);
        return view('publikasi.berita-index', compact('berita'));
    }

    public function show(Berita $berita)
    {
        // Cuma bisa dilihat kalau statusnya Publik
        if ($berita->status !== 'Publik') {
            abort(404);
        }

        return view('publikasi.berita-show', compact('berita'));
    }
}