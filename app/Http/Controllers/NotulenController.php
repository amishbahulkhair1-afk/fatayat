<?php

namespace App\Http\Controllers;

use App\Models\Notulen;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotulenController extends Controller
{
    public function index(Request $request)
    {
        $query = Notulen::with('kegiatan');

        if ($request->filled('cari')) {
            $query->where('judul', 'like', '%' . $request->cari . '%');
        }

        $notulen = $query->latest('tanggal')->paginate(10)->withQueryString();

        return view('notulen.index', compact('notulen'));
    }

    public function create()
    {
        $kegiatan = Kegiatan::orderByDesc('tanggal_kegiatan')->get();
        return view('notulen.create', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kegiatan_id' => 'nullable|exists:kegiatan,id',
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'pemimpin_rapat' => 'nullable|string|max:255',
            'notulis' => 'nullable|string|max:255',
            'isi_notulen' => 'required|string',
            'file_lampiran' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('file_lampiran')) {
            $validated['file_lampiran'] = $request->file('file_lampiran')->store('notulen', 'public');
        }

        Notulen::create($validated);

        return redirect()->route('notulen.index')->with('success', 'Notulen berhasil disimpan.');
    }

    public function edit(Notulen $notulen)
    {
        $kegiatan = Kegiatan::orderByDesc('tanggal_kegiatan')->get();
        return view('notulen.edit', compact('notulen', 'kegiatan'));
    }

    public function update(Request $request, Notulen $notulen)
    {
        $validated = $request->validate([
            'kegiatan_id' => 'nullable|exists:kegiatan,id',
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'pemimpin_rapat' => 'nullable|string|max:255',
            'notulis' => 'nullable|string|max:255',
            'isi_notulen' => 'required|string',
            'file_lampiran' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('file_lampiran')) {
            if ($notulen->file_lampiran) {
                Storage::disk('public')->delete($notulen->file_lampiran);
            }
            $validated['file_lampiran'] = $request->file('file_lampiran')->store('notulen', 'public');
        }

        $notulen->update($validated);

        return redirect()->route('notulen.index')->with('success', 'Notulen berhasil diperbarui.');
    }

    public function destroy(Notulen $notulen)
    {
        if ($notulen->file_lampiran) {
            Storage::disk('public')->delete($notulen->file_lampiran);
        }
        $notulen->delete();

        return redirect()->route('notulen.index')->with('success', 'Notulen berhasil dihapus.');
    }
}