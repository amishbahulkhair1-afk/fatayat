<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pac;
use App\Models\Pr;
use App\Models\Par;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Anggota::with(['pac', 'pr', 'par']);

        // Batasi admin PAR hanya melihat wilayahnya
        if ($user->role === 'admin_par') {
            $query->where('par_id', $user->par_id);
        }

        // FILTER PENCARIAN
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', '%' . $search . '%')
                    ->orWhere('no_kta', 'like', '%' . $search . '%')
                    ->orWhereHas('pr', function ($pr) use ($search) {
                        $pr->where('nama', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('par', function ($par) use ($search) {
                        $par->where('nama', 'like', '%' . $search . '%');
                    });
            });
        }

        // FILTER STATUS
        if ($request->filled('status')) {
            $query->where('status_anggota', $request->status);
        }

        $anggota = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        $user = auth()->user();

        if ($user->role === 'admin_par') {
            $pac = collect();
            $pr = collect();
            $par = Par::where('id', $user->par_id)->get();
        } else {
            $pac = Pac::all();
            $pr = Pr::all();
            $par = Par::all();
        }

        return view('anggota.create', compact('pac', 'pr', 'par'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'pac_id' => 'nullable|exists:pacs,id',
            'pr_id' => 'nullable|exists:prs,id',
            'par_id' => 'nullable|exists:pars,id',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'no_telepon' => 'nullable|string|max:255',
            'alamat_lengkap' => 'nullable|string',
            'pekerjaan' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'tanggal_bergabung' => 'required|date',
            'status_anggota' => 'required|string|max:255',
            'no_kta' => 'nullable|string|max:255|unique:anggota,no_kta',
            'foto_kader' => 'nullable|image|max:2048',
            'riwayat_pendidikan' => 'nullable|string',
            'keterampilan_pekerjaan' => 'nullable|string',
        ]);

        if ($user->role === 'admin_par') {
            $validated['pac_id'] = null;
            $validated['pr_id'] = Par::find($user->par_id)->pr_id; // otomatis ambil PR induk dari PAR user
            $validated['par_id'] = $user->par_id;
        }

        if ($request->hasFile('foto_kader')) {
            $validated['foto_kader'] = $request->file('foto_kader')->store('anggota/foto', 'public');
        }

        Anggota::create($validated);

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil ditambahkan.');
    }

    public function edit(Anggota $anggota)
    {
        $user = auth()->user();
        if ($user->role === 'admin_par' && $anggota->par_id != $user->par_id) {
            abort(403, 'Anda tidak punya akses ke data anggota ini.');
        }

        if ($user->role === 'admin_par') {
            $pac = collect();
            $pr = collect();
            $par = Par::where('id', $user->par_id)->get();
        } else {
            $pac = Pac::all();
            $pr = Pr::all();
            $par = Par::all();
        }

        return view('anggota.edit', compact('anggota', 'pac', 'pr', 'par'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $user = auth()->user();
        if ($user->role === 'admin_par' && $anggota->par_id != $user->par_id) {
            abort(403, 'Anda tidak punya akses ke data anggota ini.');
        }

        $validated = $request->validate([
            'pac_id' => 'nullable|exists:pacs,id',
            'pr_id' => 'nullable|exists:prs,id',
            'par_id' => 'nullable|exists:pars,id',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'no_telepon' => 'nullable|string|max:255',
            'alamat_lengkap' => 'nullable|string',
            'pekerjaan' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'tanggal_bergabung' => 'required|date',
            'status_anggota' => 'required|string|max:255',
            'no_kta' => 'nullable|string|max:255|unique:anggota,no_kta,' . $anggota->id,
            'foto_kader' => 'nullable|image|max:2048',
            'riwayat_pendidikan' => 'nullable|string',
            'keterampilan_pekerjaan' => 'nullable|string',
        ]);

        if ($user->role === 'admin_par') {
            $validated['pac_id'] = null;
            $validated['pr_id'] = Par::find($user->par_id)->pr_id; // otomatis ambil PR induk dari PAR user
            $validated['par_id'] = $user->par_id;
        }

        if ($request->hasFile('foto_kader')) {
            if ($anggota->foto_kader) {
                Storage::disk('public')->delete($anggota->foto_kader);
            }
            $validated['foto_kader'] = $request->file('foto_kader')->store('anggota/foto', 'public');
        }

        $anggota->update($validated);

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        $user = auth()->user();
        if ($user->role === 'admin_par' && $anggota->par_id != $user->par_id) {
            abort(403, 'Anda tidak punya akses ke data anggota ini.');
        }

        if ($anggota->foto_kader) {
            Storage::disk('public')->delete($anggota->foto_kader);
        }
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil dihapus.');
    }
}