<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanPublikController extends Controller
{
    const KATEGORI_LIST = ['Kekerasan', 'Pelayanan', 'Administrasi', 'Lainnya'];
    const JENIS_KEKERASAN_LIST = ['KDRT', 'Pelecehan', 'Diskriminasi', 'Penelantaran', 'Lainnya'];

    public function create()
    {
        return view('pengaduan-publik.create', [
            'kategoriList' => self::KATEGORI_LIST,
            'jenisKekerasanList' => self::JENIS_KEKERASAN_LIST,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|string',
            'jenis_kekerasan' => 'nullable|string',
            'tanggal_pengaduan' => 'required|date',
            'nama_pelapor' => 'required|string|max:255',
            'kontak_pelapor' => 'nullable|string|max:255',
            'email_pelapor' => 'nullable|email:rfc,dns|max:255',
            'isi_pengaduan' => 'required|string',
            'bukti_pendukung' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Bikin nomor pengaduan otomatis, contoh: PGD-2026-0001
        $tahun = date('Y');
        $urutan = Pengaduan::whereYear('created_at', $tahun)->count() + 1;
        $validated['no_pengaduan'] = 'PGD-' . $tahun . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);
        $validated['user_id'] = $request->user()?->id;

        if ($request->hasFile('bukti_pendukung')) {
            $validated['bukti_pendukung'] = $request->file('bukti_pendukung')->store('pengaduan', 'public');
        }

        if (strtolower($request->kecamatan) !== 'pragaan') {
            return back()
                ->withInput()
                ->withErrors([
                    'kecamatan' => 'Layanan pengaduan ini hanya untuk wilayah Kecamatan Pragaan.'
                ]);
        }

        $pengaduan = Pengaduan::create($validated);

        return redirect()->route('pengaduan.publik.sukses', $pengaduan->no_pengaduan);
    }

    public function sukses($noPengaduan)
    {
        return view('pengaduan-publik.sukses', compact('noPengaduan'));
    }

    public function cekStatus()
    {
        return view('pengaduan-publik.cek-status');
    }

    public function cariStatus(Request $request)
    {
        $request->validate([
            'no_pengaduan' => 'required|string',
        ]);

        $pengaduan = \App\Models\Pengaduan::where('no_pengaduan', $request->no_pengaduan)->first();

        if (!$pengaduan) {
            return back()->withInput()->withErrors([
                'no_pengaduan' => 'Nomor pengaduan tidak ditemukan.',
            ]);
        }

        return view('pengaduan-publik.hasil-status', compact('pengaduan'));
    }
}
