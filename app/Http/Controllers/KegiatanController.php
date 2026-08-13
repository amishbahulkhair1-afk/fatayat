<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    const JENIS_LIST = ['Rapat', 'Pelatihan', 'Sosialisasi', 'Peringatan Hari Besar', 'Kegiatan Sosial', 'Lainnya'];
    const STATUS_LIST = ['Terjadwal', 'Berlangsung', 'Selesai', 'Dibatalkan'];

    public function index(Request $request)
    {
        $query = Kegiatan::with('penanggungJawab');

        if ($request->filled('nama')) {
            $query->where('nama_kegiatan', 'like', '%' . $request->nama . '%');
        }
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_kegiatan', $request->tanggal);
        }
        if ($request->filled('status')) {
            $query->where('status_kegiatan', $request->status);
        }

        $kegiatan = $query->latest('tanggal_kegiatan')->paginate(10)->withQueryString();

        return view('kegiatan.index', [
            'kegiatan' => $kegiatan,
            'statusList' => self::STATUS_LIST,
        ]);
    }

    public function create()
    {
        $pengurus = Pengurus::orderBy('nama_lengkap')->get();
        $lembaga = \App\Models\Lembaga::all();
        return view('kegiatan.create', [
            'pengurus' => $pengurus,
            'lembaga' => $lembaga,
            'jenisList' => self::JENIS_LIST,
            'statusList' => self::STATUS_LIST,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'jenis_kegiatan' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'nullable|after:jam_mulai',
            'lokasi_kegiatan' => 'nullable|string|max:255',
            'penanggung_jawab_id' => 'nullable|exists:pengurus,id',
            'lembaga_id' => 'nullable|exists:lembaga,id',
            'deskripsi_kegiatan' => 'nullable|string',
            'target_peserta' => 'required|in:semua,tertentu',
            'status_kegiatan' => 'required|string',
            'peserta' => 'nullable|array',
            'peserta.*' => 'exists:pengurus,id',
        ]);

        $kegiatan = Kegiatan::create($validated);

        if ($validated['target_peserta'] === 'tertentu' && $request->has('peserta')) {
            $kegiatan->pesertaTertentu()->sync($request->peserta);
        }

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit(Kegiatan $kegiatan)
    {
        $pengurus = Pengurus::orderBy('nama_lengkap')->get();
        $lembaga = \App\Models\Lembaga::all();
        $pesertaTerpilih = $kegiatan->pesertaTertentu->pluck('id')->toArray();
        return view('kegiatan.edit', [
            'kegiatan' => $kegiatan,
            'pengurus' => $pengurus,
            'lembaga' => $lembaga,
            'pesertaTerpilih' => $pesertaTerpilih,
            'jenisList' => self::JENIS_LIST,
            'statusList' => self::STATUS_LIST,
        ]);
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'jenis_kegiatan' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'nullable|after:jam_mulai',
            'lokasi_kegiatan' => 'nullable|string|max:255',
            'penanggung_jawab_id' => 'nullable|exists:pengurus,id',
            'lembaga_id' => 'nullable|exists:lembaga,id',
            'deskripsi_kegiatan' => 'nullable|string',
            'target_peserta' => 'required|in:semua,tertentu',
            'status_kegiatan' => 'required|string',
            'peserta' => 'nullable|array',
            'peserta.*' => 'exists:pengurus,id',
        ]);

        $kegiatan->update($validated);

        if ($validated['target_peserta'] === 'tertentu') {
            $kegiatan->pesertaTertentu()->sync($request->peserta ?? []);
        } else {
            $kegiatan->pesertaTertentu()->sync([]);
        }

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}