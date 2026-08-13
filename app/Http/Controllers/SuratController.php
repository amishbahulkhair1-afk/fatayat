<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    const JENIS_SURAT_LIST = ['Surat Undangan', 'Surat Keputusan', 'Surat Edaran', 'Surat Keterangan', 'Surat Tugas', 'Lainnya'];
    const SIFAT_LIST = ['Biasa', 'Penting', 'Rahasia'];

    public function index(Request $request)
    {
        $jenis = $request->get('jenis', 'Masuk'); // default tab: Surat Masuk

        $query = Surat::where('jenis', $jenis);

        if ($request->filled('jenis_surat')) {
            $query->where('jenis_surat', $request->jenis_surat);
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }
        if ($request->filled('cari')) {
            $query->where(function ($q) use ($request) {
                $q->where('nomor_surat', 'like', '%' . $request->cari . '%')
                    ->orWhere('perihal', 'like', '%' . $request->cari . '%');
            });
        }

        $surat = $query->latest('tanggal')->paginate(10)->withQueryString();

        return view('surat.index', [
            'surat' => $surat,
            'jenisAktif' => $jenis,
            'jenisSuratList' => self::JENIS_SURAT_LIST,
        ]);
    }

    public function create(Request $request)
    {
        $jenis = $request->get('jenis', 'Masuk');
        return view('surat.create', [
            'jenis' => $jenis,
            'jenisSuratList' => self::JENIS_SURAT_LIST,
            'sifatList' => self::SIFAT_LIST,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:Masuk,Keluar',
            'nomor_surat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'pengirim_tujuan' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'jenis_surat' => 'required|string',
            'sifat_surat' => 'required|string',
            'file_surat' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file_surat')) {
            $validated['file_surat'] = $request->file('file_surat')->store('surat', 'public');
        }

        Surat::create($validated);

        return redirect()->route('surat.index', ['jenis' => $validated['jenis']])->with('success', 'Surat berhasil ditambahkan.');
    }

    public function edit(Surat $surat)
    {
        return view('surat.edit', [
            'surat' => $surat,
            'jenisSuratList' => self::JENIS_SURAT_LIST,
            'sifatList' => self::SIFAT_LIST,
        ]);
    }

    public function update(Request $request, Surat $surat)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'pengirim_tujuan' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'jenis_surat' => 'required|string',
            'sifat_surat' => 'required|string',
            'file_surat' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file_surat')) {
            if ($surat->file_surat) {
                Storage::disk('public')->delete($surat->file_surat);
            }
            $validated['file_surat'] = $request->file('file_surat')->store('surat', 'public');
        }

        $surat->update($validated);

        return redirect()->route('surat.index', ['jenis' => $surat->jenis])->with('success', 'Surat berhasil diperbarui.');
    }

    public function destroy(Surat $surat)
    {
        if ($surat->file_surat) {
            Storage::disk('public')->delete($surat->file_surat);
        }
        $jenis = $surat->jenis;
        $surat->delete();

        return redirect()->route('surat.index', ['jenis' => $jenis])->with('success', 'Surat berhasil dihapus.');
    }
}