<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Models\ProgramKerja;
use Illuminate\Http\Request;

class ProgramKerjaController extends Controller
{
    public function index(Lembaga $lembaga)
    {
        $programKerja = $lembaga->programKerja()->latest()->paginate(10);
        return view('program-kerja.index', compact('lembaga', 'programKerja'));
    }

    public function create(Lembaga $lembaga)
    {
        return view('program-kerja.create', compact('lembaga'));
    }

    public function store(Request $request, Lembaga $lembaga)
    {
        $validated = $request->validate([
            'nama_program_kerja' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:Selesai,Tidak Selesai',
        ]);

        $lembaga->programKerja()->create($validated);

        return redirect()->route('lembaga.program-kerja.index', $lembaga->id)->with('success', 'Program kerja berhasil ditambahkan.');
    }

    public function edit(Lembaga $lembaga, ProgramKerja $program_kerja)
    {
        return view('program-kerja.edit', compact('lembaga', 'program_kerja'));
    }

    public function update(Request $request, Lembaga $lembaga, ProgramKerja $program_kerja)
    {
        $validated = $request->validate([
            'nama_program_kerja' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:Selesai,Tidak Selesai',
        ]);

        $program_kerja->update($validated);

        return redirect()->route('lembaga.program-kerja.index', $lembaga->id)->with('success', 'Program kerja berhasil diperbarui.');
    }

    public function destroy(Lembaga $lembaga, ProgramKerja $program_kerja)
    {
        $program_kerja->delete();

        return redirect()->route('lembaga.program-kerja.index', $lembaga->id)->with('success', 'Program kerja berhasil dihapus.');
    }
}