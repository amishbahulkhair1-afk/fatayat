<?php

namespace App\Http\Controllers;

use App\Models\DokumentasiKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumentasiController extends Controller
{
    const KATEGORI_LIST = ['Rapat', 'Pelatihan', 'Sosialisasi', 'Bakti Sosial', 'Peringatan Hari Besar', 'Lainnya'];

    public function index(Request $request)
    {
        $query = DokumentasiKegiatan::query();

        if ($request->filled('cari')) {
            $query->where('judul_dokumentasi', 'like', '%' . $request->cari . '%');
        }
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_kegiatan', $request->tanggal);
        }

        $dokumentasi = $query->latest()->paginate(10)->withQueryString();

        return view('dokumentasi.index', [
            'dokumentasi' => $dokumentasi,
            'kategoriList' => self::KATEGORI_LIST,
        ]);
    }

    public function create()
    {
        return view('dokumentasi.create', ['kategoriList' => self::KATEGORI_LIST]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_dokumentasi' => 'required|string|max:255',
            'kategori' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'deskripsi_singkat' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
            'status' => 'required|in:Publikasi,Draft',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('dokumentasi', 'public');
        }

        DokumentasiKegiatan::create($validated);

        return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi berhasil disimpan.');
    }

    public function edit(DokumentasiKegiatan $dokumentasi)
    {
        return view('dokumentasi.edit', ['dokumentasi' => $dokumentasi, 'kategoriList' => self::KATEGORI_LIST]);
    }

    public function update(Request $request, DokumentasiKegiatan $dokumentasi)
    {
        $validated = $request->validate([
            'judul_dokumentasi' => 'required|string|max:255',
            'kategori' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'deskripsi_singkat' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
            'status' => 'required|in:Publikasi,Draft',
        ]);

        if ($request->hasFile('foto')) {
            if ($dokumentasi->foto) {
                Storage::disk('public')->delete($dokumentasi->foto);
            }
            $validated['foto'] = $request->file('foto')->store('dokumentasi', 'public');
        }

        $dokumentasi->update($validated);

        return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi berhasil diperbarui.');
    }

    public function destroy(DokumentasiKegiatan $dokumentasi)
    {
        if ($dokumentasi->foto) {
            Storage::disk('public')->delete($dokumentasi->foto);
        }
        $dokumentasi->delete();

        return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi berhasil dihapus.');
    }
}