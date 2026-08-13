<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pr;
use App\Models\Pac;
use App\Models\Pengurus;

class PrController extends Controller
{
    public function index(Request $request)
    {
        $query = Pr::with(['pac', 'ketua']);

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('kode_pr', 'like', "%{$search}%")
                    ->orWhere('desa', 'like', "%{$search}%")
                    ->orWhere('kecamatan', 'like', "%{$search}%");
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pr = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pr.index', compact('pr'));
    }

    public function create()
    {
        $pac = Pac::all();
        $pengurus = Pengurus::orderBy('nama_lengkap')->get();
        return view('pr.create', compact('pac', 'pengurus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pac_id' => 'required|exists:pacs,id',
            'nama' => 'required|string|max:255',
            'kode_pr' => 'required|string|max:255|unique:prs,kode_pr',
            'desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'tanggal_dibentuk' => 'required|date',
            'status' => 'required|string|max:255',
            'ketua_id' => 'nullable|exists:pengurus,id',
            'sekertaris_id' => 'nullable|exists:pengurus,id',
            'bendahara_id' => 'nullable|exists:pengurus,id',
            'no_telepon' => 'nullable|string|max:255',
            'alamat_sekertaris' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        Pr::create($validated);

        return redirect()->route('pr.index')->with('success', 'Data PR berhasil ditambahkan.');
    }

    public function edit(Pr $pr)
    {
        $pac = Pac::all();
        $pengurus = Pengurus::orderBy('nama_lengkap')->get();
        return view('pr.edit', compact('pr', 'pac', 'pengurus'));
    }

    public function update(Request $request, Pr $pr)
    {
        $validated = $request->validate([
            'pac_id' => 'required|exists:pacs,id',
            'nama' => 'required|string|max:255',
            'kode_pr' => 'required|string|max:255|unique:prs,kode_pr,' . $pr->id,
            'desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'tanggal_dibentuk' => 'required|date',
            'status' => 'required|string|max:255',
            'ketua_id' => 'nullable|exists:pengurus,id',
            'sekertaris_id' => 'nullable|exists:pengurus,id',
            'bendahara_id' => 'nullable|exists:pengurus,id',
            'no_telepon' => 'nullable|string|max:255',
            'alamat_sekertaris' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        $pr->update($validated);

        return redirect()->route('pr.index')->with('success', 'Data PR berhasil diperbarui.');
    }

    public function destroy(Pr $pr)
    {
        $pr->delete();

        return redirect()->route('pr.index')->with('success', 'Data PR berhasil dihapus.');
    }
}