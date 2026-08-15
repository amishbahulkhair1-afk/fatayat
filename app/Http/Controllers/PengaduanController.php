<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Notifications\PengaduanDitanggapi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PengaduanController extends Controller
{
    const KATEGORI_LIST = ['Kekerasan', 'Pelayanan', 'Administrasi', 'Lainnya'];

    public function index(Request $request)
    {
        $query = Pengaduan::query();

        if ($request->filled('cari')) {
            $query->where(function ($q) use ($request) {
                $q->where('no_pengaduan', 'like', '%' . $request->cari . '%')
                    ->orWhere('nama_pelapor', 'like', '%' . $request->cari . '%');
            });
        }
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_pengaduan', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_pengaduan', $request->tahun);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengaduan = $query->latest()->paginate(10)->withQueryString();

        $ringkasan = [
            'diproses' => Pengaduan::where('status', 'Diproses')->count(),
            'selesai' => Pengaduan::where('status', 'Selesai')->count(),
            'ditolak' => Pengaduan::where('status', 'Ditolak')->count(),
        ];

        return view('pengaduan.index', [
            'pengaduan' => $pengaduan,
            'ringkasan' => $ringkasan,
            'kategoriList' => self::KATEGORI_LIST,
        ]);
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('pengaduan.show', compact('pengaduan'));
    }

    public function edit(Pengaduan $pengaduan)
    {
        return view('pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate([
            'tanggapan_admin' => 'nullable|string',
        ]);

        $tanggapanBerubah = $pengaduan->tanggapan_admin !== ($validated['tanggapan_admin'] ?? null);

        $pengaduan->update($validated);

        if ($tanggapanBerubah && filled($pengaduan->tanggapan_admin)) {
            if ($pengaduan->user) {
                $pengaduan->user->notify(new PengaduanDitanggapi($pengaduan));
            } elseif (filled($pengaduan->email_pelapor)) {
                Notification::route('mail', $pengaduan->email_pelapor)
                    ->notify(new PengaduanDitanggapi($pengaduan));
            }
        }

        return redirect()->route('pengaduan.show', $pengaduan->id)->with('success', 'Tanggapan berhasil disimpan.');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus.');
    }

    public function proses(Pengaduan $pengaduan)
    {
        $pengaduan->update(['status' => 'Diproses']);
        return redirect()->route('pengaduan.show', $pengaduan->id)->with('success', 'Pengaduan ditandai sedang diproses.');
    }

    public function tolak(Pengaduan $pengaduan)
    {
        $pengaduan->update(['status' => 'Ditolak']);
        return redirect()->route('pengaduan.show', $pengaduan->id)->with('success', 'Pengaduan ditolak.');
    }

    public function selesai(Pengaduan $pengaduan)
    {
        $pengaduan->update(['status' => 'Selesai']);
        return redirect()->route('pengaduan.show', $pengaduan->id)->with('success', 'Pengaduan ditandai selesai.');
    }
}
