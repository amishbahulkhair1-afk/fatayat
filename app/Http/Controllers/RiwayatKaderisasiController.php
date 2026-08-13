<?php

namespace App\Http\Controllers;

use App\Models\RiwayatKaderisasi;
use App\Models\Pengurus;
use App\Models\Anggota;
use App\Models\Pr;
use App\Models\Par;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RiwayatKaderisasiController extends Controller
{
    const JENJANG_LIST = ['LKD', 'LKL', 'LKN', 'LKD Khusus'];

    public function index(Request $request)
    {
        $query = RiwayatKaderisasi::with(['pengurus', 'anggota']);

        if ($request->filled('jenjang')) {
            $query->where('jenjang_kaderisasi', $request->jenjang);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->whereHas('pengurus', fn($sub) => $sub->where('nama_lengkap', 'like', "%{$cari}%"))
                    ->orWhereHas('anggota', fn($sub) => $sub->where('nama_lengkap', 'like', "%{$cari}%"));
            });
        }

        $riwayat = $query->latest()->paginate(10)->withQueryString();

        return view('riwayat-kaderisasi.index', [
            'riwayat' => $riwayat,
            'jenjangList' => self::JENJANG_LIST,
        ]);
    }

    public function create()
    {
        $pengurus = Pengurus::orderBy('nama_lengkap')->get();
        $anggota = Anggota::orderBy('nama_lengkap')->get();
        $pr = Pr::all();
        $par = Par::all();
        return view('riwayat-kaderisasi.create', [
            'pengurus' => $pengurus,
            'anggota' => $anggota,
            'pr' => $pr,
            'par' => $par,
            'jenjangList' => self::JENJANG_LIST,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pengurus_id' => 'nullable|exists:pengurus,id|required_without:anggota_id',
            'anggota_id' => 'nullable|exists:anggota,id|required_without:pengurus_id',
            'jabatan' => 'nullable|string|max:255',
            'pr_id' => 'nullable|exists:prs,id',
            'par_id' => 'nullable|exists:pars,id',
            'penyelenggara' => 'nullable|string|max:255',
            'jenjang_kaderisasi' => 'required|string',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'no_sertifikat' => 'nullable|string|max:255',
            'tahun' => 'nullable|digits:4|integer',
            'upload_sertifikat' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $validated['status'] = $request->filled('pengurus_id') ? 'Pengurus' : 'Anggota';

        if ($request->hasFile('upload_sertifikat')) {
            $validated['upload_sertifikat'] = $request->file('upload_sertifikat')->store('kaderisasi/sertifikat', 'public');
        }

        RiwayatKaderisasi::create($validated);

        return redirect()->route('riwayat-kaderisasi.index')->with('success', 'Riwayat kaderisasi berhasil ditambahkan.');
    }

    public function edit(RiwayatKaderisasi $riwayat_kaderisasi)
    {
        $pengurus = Pengurus::orderBy('nama_lengkap')->get();
        $anggota = Anggota::orderBy('nama_lengkap')->get();
        $pr = Pr::all();
        $par = Par::all();
        return view('riwayat-kaderisasi.edit', [
            'riwayat' => $riwayat_kaderisasi,
            'pengurus' => $pengurus,
            'anggota' => $anggota,
            'pr' => $pr,
            'par' => $par,
            'jenjangList' => self::JENJANG_LIST,
        ]);
    }

    public function update(Request $request, RiwayatKaderisasi $riwayat_kaderisasi)
    {
        $validated = $request->validate([
            'pengurus_id' => 'nullable|exists:pengurus,id|required_without:anggota_id',
            'anggota_id' => 'nullable|exists:anggota,id|required_without:pengurus_id',
            'jabatan' => 'nullable|string|max:255',
            'pr_id' => 'nullable|exists:prs,id',
            'par_id' => 'nullable|exists:pars,id',
            'penyelenggara' => 'nullable|string|max:255',
            'jenjang_kaderisasi' => 'required|string',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'no_sertifikat' => 'nullable|string|max:255',
            'tahun' => 'nullable|digits:4|integer',
            'upload_sertifikat' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $validated['status'] = $request->filled('pengurus_id') ? 'Pengurus' : 'Anggota';

        if ($request->hasFile('upload_sertifikat')) {
            if ($riwayat_kaderisasi->upload_sertifikat) {
                Storage::disk('public')->delete($riwayat_kaderisasi->upload_sertifikat);
            }
            $validated['upload_sertifikat'] = $request->file('upload_sertifikat')->store('kaderisasi/sertifikat', 'public');
        }

        $riwayat_kaderisasi->update($validated);

        return redirect()->route('riwayat-kaderisasi.index')->with('success', 'Riwayat kaderisasi berhasil diperbarui.');
    }

    public function destroy(RiwayatKaderisasi $riwayat_kaderisasi)
    {
        if ($riwayat_kaderisasi->upload_sertifikat) {
            Storage::disk('public')->delete($riwayat_kaderisasi->upload_sertifikat);
        }
        $riwayat_kaderisasi->delete();

        return redirect()->route('riwayat-kaderisasi.index')->with('success', 'Riwayat kaderisasi berhasil dihapus.');
    }
}