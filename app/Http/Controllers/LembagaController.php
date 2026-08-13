<?php
namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Models\Pac;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class LembagaController extends Controller
{


    public function index(Request $request)
    {
        $query = Lembaga::with(['pac', 'ketua']);

        // Search
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_lembaga', 'like', '%' . $request->q . '%')
                    ->orWhere('singkatan', 'like', '%' . $request->q . '%');
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $lembaga = $query->latest()->paginate(10)->withQueryString();

        return view('lembaga.index', compact('lembaga'));
    }

    public function create()
    {
        $pac = Pac::all();
        $pengurus = Pengurus::orderBy('nama_lengkap')->get();
        return view('lembaga.create', compact('pac', 'pengurus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pac_id' => 'required|exists:pacs,id',
            'nama_lembaga' => 'required|string|max:255',
            'singkatan' => 'nullable|string|max:50',
            'ketua_id' => 'nullable|exists:pengurus,id',
            'tanggal_dibentuk' => 'nullable|date',
            'status' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'kontak' => 'nullable|string|max:255',
        ]);

        Lembaga::create($validated);

        return redirect()->route('lembaga.index')->with('success', 'Data lembaga berhasil ditambahkan.');
    }

    public function edit(Lembaga $lembaga)
    {
        $pac = Pac::all();
        $pengurus = Pengurus::orderBy('nama_lengkap')->get();
        return view('lembaga.edit', compact('lembaga', 'pac', 'pengurus'));
    }

    public function update(Request $request, Lembaga $lembaga)
    {
        $validated = $request->validate([
            'pac_id' => 'required|exists:pacs,id',
            'nama_lembaga' => 'required|string|max:255',
            'singkatan' => 'nullable|string|max:50',
            'ketua_id' => 'nullable|exists:pengurus,id',
            'tanggal_dibentuk' => 'nullable|date',
            'status' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'kontak' => 'nullable|string|max:255',
        ]);

        $lembaga->update($validated);

        return redirect()->route('lembaga.index')->with('success', 'Data lembaga berhasil diperbarui.');
    }

    public function destroy(Lembaga $lembaga)
    {
        $lembaga->delete();

        return redirect()->route('lembaga.index')->with('success', 'Data lembaga berhasil dihapus.');
    }
}