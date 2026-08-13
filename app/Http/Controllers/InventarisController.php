<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    const KATEGORI_LIST = ['Elektronik', 'Furniture', 'Alat Tulis Kantor', 'Kendaraan', 'Lainnya'];
    const LOKASI_LIST = ['Kantor Sekretariat', 'Gudang', 'Ruang Rapat', 'Lainnya'];

    public function index(Request $request)
    {
        $query = Inventaris::query();

        if ($request->filled('cari')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->cari . '%')
                    ->orWhere('kode_inventaris', 'like', '%' . $request->cari . '%');
            });
        }
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }
        if ($request->filled('lokasi')) {
            $query->where('lokasi_penyimpanan', $request->lokasi);
        }

        $inventaris = $query->latest()->paginate(10)->withQueryString();

        $ringkasan = [
            'total' => Inventaris::count(),
            'baik' => Inventaris::where('kondisi', 'Baik')->count(),
            'rusak_ringan' => Inventaris::where('kondisi', 'Rusak Ringan')->count(),
            'rusak_berat' => Inventaris::where('kondisi', 'Rusak Berat')->count(),
        ];

        return view('inventaris.index', [
            'inventaris' => $inventaris,
            'ringkasan' => $ringkasan,
            'kategoriList' => self::KATEGORI_LIST,
            'lokasiList' => self::LOKASI_LIST,
        ]);
    }

    public function create()
    {
        return view('inventaris.create', [
            'kategoriList' => self::KATEGORI_LIST,
            'lokasiList' => self::LOKASI_LIST,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_inventaris' => 'required|string|max:255|unique:inventaris,kode_inventaris',
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string',
            'merk_tipe' => 'nullable|string|max:255',
            'tahun_perolehan' => 'nullable|digits:4|integer',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'lokasi_penyimpanan' => 'nullable|string',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
        ]);

        Inventaris::create($validated);

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil ditambahkan.');
    }

    public function edit(Inventaris $inventaris)
    {
        return view('inventaris.edit', [
            'inventaris' => $inventaris,
            'kategoriList' => self::KATEGORI_LIST,
            'lokasiList' => self::LOKASI_LIST,
        ]);
    }

    public function update(Request $request, Inventaris $inventaris)
    {
        $validated = $request->validate([
            'kode_inventaris' => 'required|string|max:255|unique:inventaris,kode_inventaris,' . $inventaris->id,
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string',
            'merk_tipe' => 'nullable|string|max:255',
            'tahun_perolehan' => 'nullable|digits:4|integer',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'lokasi_penyimpanan' => 'nullable|string',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
        ]);

        $inventaris->update($validated);

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil diperbarui.');
    }

    public function show(Inventaris $inventaris)
    {
        $riwayatPeminjaman = $inventaris->peminjaman()->with('pengurus')->latest()->paginate(10);
        return view('inventaris.show', compact('inventaris', 'riwayatPeminjaman'));
    }

    public function destroy(Inventaris $inventaris)
    {
        $inventaris->delete();

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil dihapus.');
    }
}