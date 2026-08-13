<?php

namespace App\Http\Controllers;

use App\Models\Pac;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class PacController extends Controller
{
    public function index(Request $request)
    {
        $query = Pac::with('ketua');

        // SEARCH
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('kecamatan', 'like', '%' . $request->search . '%');
            });
        }

        // FILTER STATUS
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // URUTKAN TERBARU
        $pac = $query->latest()->paginate(10)->withQueryString();

        return view('pac.index', compact('pac'));
    }

    public function create()
    {
        $pengurus = Pengurus::orderBy('nama_lengkap')->get();
        return view('pac.create', compact('pengurus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'tanggal_dibentuk' => 'required|date',
            'status' => 'required|string|max:255',
            'ketua_id' => 'nullable|exists:pengurus,id',
            'sekertaris_id' => 'nullable|exists:pengurus,id',
            'bendahara_id' => 'nullable|exists:pengurus,id',
            'kontak' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Pac::create($validated);

        return redirect()->route('pac.index')->with('success', 'Data PAC berhasil ditambahkan.');
    }

    public function edit(Pac $pac)
    {
        $pengurus = Pengurus::orderBy('nama_lengkap')->get();
        return view('pac.edit', compact('pac', 'pengurus'));
    }

    public function update(Request $request, Pac $pac)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'tanggal_dibentuk' => 'required|date',
            'status' => 'required|string|max:255',
            'ketua_id' => 'nullable|exists:pengurus,id',
            'sekertaris_id' => 'nullable|exists:pengurus,id',
            'bendahara_id' => 'nullable|exists:pengurus,id',
            'jumlah_anggota' => 'nullable|integer|min:0',
            'kontak' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $pac->update($validated);

        return redirect()->route('pac.index')->with('success', 'Data PAC berhasil diperbarui.');
    }

    public function destroy(Pac $pac)
    {
        $pac->delete();

        return redirect()->route('pac.index')->with('success', 'Data PAC berhasil dihapus.');
    }
}