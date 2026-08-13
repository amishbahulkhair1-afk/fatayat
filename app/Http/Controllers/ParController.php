<?php

namespace App\Http\Controllers;

use App\Models\Par;
use App\Models\Pr;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class ParController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Par::with(['pr', 'ketua']);

        // Batasi data untuk admin PR
        if ($user->role === 'admin_pr') {
            $query->where('pr_id', $user->pr_id);
        }

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhereHas('pr', function ($pr) use ($search) {
                        $pr->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $par = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('par.index', compact('par'));
    }

    public function create()
    {
        $user = auth()->user();
        $pr = $user->role === 'admin_pr' ? Pr::where('id', $user->pr_id)->get() : Pr::all();
        $pengurus = Pengurus::orderBy('nama_lengkap')->get();
        return view('par.create', compact('pr', 'pengurus'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'pr_id' => 'required|exists:prs,id',
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

        if ($user->role === 'admin_pr' && $validated['pr_id'] != $user->pr_id) {
            abort(403, 'Anda hanya bisa menambah data PAR di wilayah PR Anda.');
        }

        Par::create($validated);

        return redirect()->route('par.index')->with('success', 'Data PAR berhasil ditambahkan.');
    }

    public function edit(Par $par)
    {
        $user = auth()->user();
        if ($user->role === 'admin_pr' && $par->pr_id != $user->pr_id) {
            abort(403, 'Anda tidak punya akses ke data PAR ini.');
        }

        $pr = $user->role === 'admin_pr' ? Pr::where('id', $user->pr_id)->get() : Pr::all();
        $pengurus = Pengurus::orderBy('nama_lengkap')->get();
        return view('par.edit', compact('par', 'pr', 'pengurus'));
    }

    public function update(Request $request, Par $par)
    {
        $user = auth()->user();
        if ($user->role === 'admin_pr' && $par->pr_id != $user->pr_id) {
            abort(403, 'Anda tidak punya akses ke data PAR ini.');
        }

        $validated = $request->validate([
            'pr_id' => 'required|exists:prs,id',
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

        if ($user->role === 'admin_pr' && $validated['pr_id'] != $user->pr_id) {
            abort(403, 'Anda tidak bisa memindahkan PAR ke wilayah PR lain.');
        }

        $par->update($validated);

        return redirect()->route('par.index')->with('success', 'Data PAR berhasil diperbarui.');
    }

    public function destroy(Par $par)
    {
        $user = auth()->user();
        if ($user->role === 'admin_pr' && $par->pr_id != $user->pr_id) {
            abort(403, 'Anda tidak punya akses ke data PAR ini.');
        }

        $par->delete();

        return redirect()->route('par.index')->with('success', 'Data PAR berhasil dihapus.');
    }
}