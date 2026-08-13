<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pengurus;
use App\Models\Pac;
use App\Models\Pr;
use App\Models\Par;
use App\Models\Lembaga;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Jabatan::with(['pengurus', 'pac', 'pr', 'par', 'lembaga']);

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_jabatan', 'like', '%' . $search . '%')
                    ->orWhereHas('pengurus', function ($qq) use ($search) {
                        $qq->where('nama_lengkap', 'like', '%' . $search . '%');
                    });
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $jabatan = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('jabatan.index', compact('jabatan'));
    }

    public function create()
    {
        $pengurus = Pengurus::orderBy('nama_lengkap')->get();
        $pac = Pac::all();
        $pr = Pr::all();
        $par = Par::all();
        $lembaga = Lembaga::all();
        return view('jabatan.create', compact('pengurus', 'pac', 'pr', 'par', 'lembaga'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pengurus_id' => 'required|exists:pengurus,id',
            'pac_id' => 'nullable|exists:pacs,id',
            'pr_id' => 'nullable|exists:prs,id',
            'par_id' => 'nullable|exists:pars,id',
            'lembaga_id' => 'nullable|exists:lembaga,id',
            'nama_jabatan' => 'required|string|max:255',
            'periode_mulai' => 'required|digits:4|integer',
            'periode_selesai' => 'required|digits:4|integer|gte:periode_mulai',
            'status' => 'required|string|max:255',
        ]);

        Jabatan::create($validated);

        return redirect()->route('jabatan.index')->with('success', 'Data jabatan berhasil ditambahkan.');
    }

    public function edit(Jabatan $jabatan)
    {
        $pengurus = Pengurus::orderBy('nama_lengkap')->get();
        $pac = Pac::all();
        $pr = Pr::all();
        $par = Par::all();
        $lembaga = Lembaga::all();
        return view('jabatan.edit', compact('jabatan', 'pengurus', 'pac', 'pr', 'par', 'lembaga'));
    }

    public function update(Request $request, Jabatan $jabatan)
    {
        $validated = $request->validate([
            'pengurus_id' => 'required|exists:pengurus,id',
            'pac_id' => 'nullable|exists:pacs,id',
            'pr_id' => 'nullable|exists:prs,id',
            'par_id' => 'nullable|exists:pars,id',
            'lembaga_id' => 'nullable|exists:lembaga,id',
            'nama_jabatan' => 'required|string|max:255',
            'periode_mulai' => 'required|digits:4|integer',
            'periode_selesai' => 'required|digits:4|integer|gte:periode_mulai',
            'status' => 'required|string|max:255',
        ]);

        $jabatan->update($validated);

        return redirect()->route('jabatan.index')->with('success', 'Data jabatan berhasil diperbarui.');
    }

    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();

        return redirect()->route('jabatan.index')->with('success', 'Data jabatan berhasil dihapus.');
    }
}