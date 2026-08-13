<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function input(Kegiatan $kegiatan)
    {
        // Tentukan daftar pengurus yang perlu diabsen
        if ($kegiatan->target_peserta === 'tertentu') {
            $daftarPengurus = $kegiatan->pesertaTertentu;
        } else {
            $daftarPengurus = \App\Models\Pengurus::orderBy('nama_lengkap')->get();
        }

        // Ambil data absensi yang sudah ada (kalau sebelumnya sudah pernah diisi)
        $absensiSudahAda = $kegiatan->absensi->keyBy('pengurus_id');

        return view('absensi.input', compact('kegiatan', 'daftarPengurus', 'absensiSudahAda'));
    }

    public function simpan(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'kehadiran' => 'required|array',
            'kehadiran.*.status' => 'required|in:Hadir,Tidak Hadir',
            'kehadiran.*.keterangan' => 'nullable|string|max:255',
        ]);

        foreach ($validated['kehadiran'] as $pengurusId => $data) {
            Absensi::updateOrCreate(
                ['kegiatan_id' => $kegiatan->id, 'pengurus_id' => $pengurusId],
                ['status_kehadiran' => $data['status'], 'keterangan' => $data['keterangan'] ?? null]
            );
        }

        return redirect()->route('kegiatan.index')->with('success', 'Absensi berhasil disimpan.');
    }

    public function detail(Kegiatan $kegiatan)
    {
        $absensi = $kegiatan->absensi()->with('pengurus')->get();
        return view('absensi.detail', compact('kegiatan', 'absensi'));
    }
}