<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use Illuminate\Http\Request;

class BukuTamuController extends Controller
{
    public function index(Request $request)
    {
        $query = BukuTamu::query();

        if ($request->filled('cari')) {
            $query->where('nama_tamu', 'like', '%' . $request->cari . '%');
        }

        $bukuTamu = $query->latest('tanggal_kunjungan')->paginate(10)->withQueryString();

        return view('buku-tamu.index', compact('bukuTamu'));
    }

    public function create()
    {
        return view('buku-tamu.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_tamu' => 'required|string|max:255',
            'asal_instansi' => 'nullable|string|max:255',
            'tujuan_kunjungan' => 'required|string|max:255',
            'tanggal_kunjungan' => 'required|date',
            'jam_kunjungan' => 'nullable',
            'kontak' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        BukuTamu::create($validated);

        return redirect()->route('buku-tamu.index')->with('success', 'Data tamu berhasil dicatat.');
    }

    public function edit(BukuTamu $bukuTamu)
    {
        return view('buku-tamu.edit', compact('bukuTamu'));
    }

    public function update(Request $request, BukuTamu $bukuTamu)
    {
        $validated = $request->validate([
            'nama_tamu' => 'required|string|max:255',
            'asal_instansi' => 'nullable|string|max:255',
            'tujuan_kunjungan' => 'required|string|max:255',
            'tanggal_kunjungan' => 'required|date',
            'jam_kunjungan' => 'nullable',
            'kontak' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $bukuTamu->update($validated);

        return redirect()->route('buku-tamu.index')->with('success', 'Data tamu berhasil diperbarui.');
    }

    public function destroy(BukuTamu $bukuTamu)
    {
        $bukuTamu->delete();

        return redirect()->route('buku-tamu.index')->with('success', 'Data tamu berhasil dihapus.');
    }
}