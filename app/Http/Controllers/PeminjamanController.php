<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanInventaris;
use App\Models\Inventaris;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = PeminjamanInventaris::with(['inventaris', 'pengurus']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $peminjaman = $query->latest()->paginate(10)->withQueryString();

        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $inventaris = Inventaris::all();
        $pengurus = Pengurus::orderBy('nama_lengkap')->get();
        return view('peminjaman.create', compact('inventaris', 'pengurus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'inventaris_id' => 'required|exists:inventaris,id',
            'pengurus_id' => 'required|exists:pengurus,id',
            'jumlah_pinjam' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali_rencana' => 'required|date|after_or_equal:tanggal_pinjam',
            'keterangan' => 'nullable|string',
        ]);

        $barang = Inventaris::findOrFail($validated['inventaris_id']);

        if ($validated['jumlah_pinjam'] > $barang->jumlah) {
            return back()->withInput()->withErrors([
                'jumlah_pinjam' => 'Stok tidak cukup. Tersedia: ' . $barang->jumlah . ' ' . $barang->satuan,
            ]);
        }

        $validated['status'] = 'Dipinjam';

        PeminjamanInventaris::create($validated);

        // Kurangi stok inventaris
        $barang->decrement('jumlah', $validated['jumlah_pinjam']);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dicatat.');
    }

    public function edit(PeminjamanInventaris $peminjaman)
    {
        $inventaris = Inventaris::all();
        $pengurus = Pengurus::orderBy('nama_lengkap')->get();
        return view('peminjaman.edit', compact('peminjaman', 'inventaris', 'pengurus'));
    }

    public function update(Request $request, PeminjamanInventaris $peminjaman)
    {
        $validated = $request->validate([
            'jumlah_pinjam' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali_rencana' => 'required|date|after_or_equal:tanggal_pinjam',
            'keterangan' => 'nullable|string',
        ]);

        // Kalau masih berstatus Dipinjam dan jumlahnya berubah, sesuaikan stok
        if ($peminjaman->status === 'Dipinjam') {
            $selisih = $validated['jumlah_pinjam'] - $peminjaman->jumlah_pinjam;
            $barang = $peminjaman->inventaris;

            if ($selisih > 0 && $selisih > $barang->jumlah) {
                return back()->withInput()->withErrors([
                    'jumlah_pinjam' => 'Stok tidak cukup untuk menambah jumlah pinjam. Tersedia: ' . $barang->jumlah,
                ]);
            }

            if ($selisih > 0) {
                $barang->decrement('jumlah', $selisih);
            } elseif ($selisih < 0) {
                $barang->increment('jumlah', abs($selisih));
            }
        }

        $peminjaman->update($validated);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy(PeminjamanInventaris $peminjaman)
    {
        // Kalau dihapus saat masih dipinjam, kembalikan dulu stoknya
        if ($peminjaman->status === 'Dipinjam') {
            $peminjaman->inventaris->increment('jumlah', $peminjaman->jumlah_pinjam);
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }

    public function kembalikan(PeminjamanInventaris $peminjaman)
    {
        if ($peminjaman->status === 'Dipinjam') {
            $peminjaman->inventaris->increment('jumlah', $peminjaman->jumlah_pinjam);

            $peminjaman->update([
                'status' => 'Dikembalikan',
                'tanggal_kembali_aktual' => now(),
            ]);
        }

        return redirect()->route('peminjaman.index')->with('success', 'Barang berhasil ditandai sudah dikembalikan.');
    }
}