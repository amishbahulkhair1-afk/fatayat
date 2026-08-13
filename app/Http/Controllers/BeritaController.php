<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    const KATEGORI_LIST = ['Rapat', 'Pelatihan', 'Sosialisasi', 'Bakti Sosial', 'Peringatan Hari Besar', 'Lainnya'];

    public function index(Request $request)
    {
        $query = Berita::query();

        if ($request->filled('cari')) {
            $query->where('judul', 'like', '%' . $request->cari . '%');
        }
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_kegiatan', $request->tanggal);
        }

        $berita = $query->latest()->paginate(10)->withQueryString();

        $ringkasan = [
            'total' => Berita::count(),
            'publik' => Berita::where('status', 'Publik')->count(),
            'draft' => Berita::where('status', 'Draft')->count(),
            'dijadwalkan' => Berita::where('status', 'Dijadwalkan')->count(),
        ];

        return view('berita.index', [
            'berita' => $berita,
            'ringkasan' => $ringkasan,
            'kategoriList' => self::KATEGORI_LIST,
        ]);
    }

    public function create()
    {
        return view('berita.create', ['kategoriList' => self::KATEGORI_LIST]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'penulis' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'lokasi' => 'nullable|string|max:255',
            'isi_berita' => 'required|string',
            'gambar_utama' => 'nullable|image|max:2048',
            'status' => 'required|in:Publik,Draft,Dijadwalkan',
        ]);

        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('berita', 'public');
        }

        Berita::create($validated);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil disimpan.');
    }

    public function edit(Berita $berita)
    {
        return view('berita.edit', ['berita' => $berita, 'kategoriList' => self::KATEGORI_LIST]);
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'penulis' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'lokasi' => 'nullable|string|max:255',
            'isi_berita' => 'required|string',
            'gambar_utama' => 'nullable|image|max:2048',
            'status' => 'required|in:Publik,Draft,Dijadwalkan',
        ]);

        if ($request->hasFile('gambar_utama')) {
            if ($berita->gambar_utama) {
                Storage::disk('public')->delete($berita->gambar_utama);
            }
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('berita', 'public');
        }

        $berita->update($validated);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar_utama) {
            Storage::disk('public')->delete($berita->gambar_utama);
        }
        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}