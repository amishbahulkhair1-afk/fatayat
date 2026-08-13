<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pengurus;

use Storage;

class PengurusController extends Controller
{

    public function index(Request $request)
    {
        $query = Pengurus::query();

        // Pencarian nama
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('tempat_lahir', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        // Filter jenis kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Filter status menikah
        if ($request->filled('status_menikah')) {
            $query->where('status_menikah', $request->status_menikah);
        }

        $pengurus = $query->latest()->paginate(10)->withQueryString();

        return view('pengurus.index', compact('pengurus'));
    }

    public function create()
    {
        return view('pengurus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // ... field Detail Pengurus yang sudah ada
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat_domisili' => 'required|string',
            'status_menikah' => 'required|in:Menikah,Belum Menikah',
            'pekerjaan' => 'nullable|string|max:255',

            // Field Pendidikan (baru)
            'sd_sederajat' => 'nullable|string|max:255',
            'sd_tahun_lulus' => 'nullable|digits:4|integer',
            'smp_sederajat' => 'nullable|string|max:255',
            'smp_tahun_lulus' => 'nullable|digits:4|integer',
            'sma_sederajat' => 'nullable|string|max:255',
            'sma_tahun_lulus' => 'nullable|digits:4|integer',
            'pondok_pesantren' => 'nullable|string|max:255',
            's1' => 'nullable|string|max:255',
            's2' => 'nullable|string|max:255',
            's3' => 'nullable|string|max:255',
            'pengkaderan_fatayat' => 'nullable|string|max:255',
            'pengkaderan_nu' => 'nullable|string|max:255',
            'pengalaman_organisasi' => 'nullable|string',
            'jabatan' => 'nullable|string|max:255',
            'asal_pr' => 'nullable|string|max:255',
            'asal_par' => 'nullable|string|max:255',
            'pelatihan' => 'nullable|string',
            'potensi' => 'nullable|string',
            'produk_usaha' => 'nullable|string',
            'prestasi' => 'nullable|string',
            'foto_ktp' => 'nullable|image|max:2048',
            'foto_seragam' => 'nullable|image|max:2048',
            'sertifikat_pengkaderan' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('foto_ktp')) {
            $validated['foto_ktp'] = $request->file('foto_ktp')->store('pengurus/ktp', 'public');
        }

        if ($request->hasFile('foto_seragam')) {
            $validated['foto_seragam'] = $request->file('foto_seragam')->store('pengurus/seragam', 'public');
        }

        if ($request->hasFile('sertifikat_pengkaderan')) {
            $validated['sertifikat_pengkaderan'] = $request->file('sertifikat_pengkaderan')->store('pengurus/sertifikat', 'public');
        }

        Pengurus::create($validated);

        return redirect()->route('pengurus.index')->with('success', 'Data pengurus berhasil ditambahkan.');

        Pengurus::create($validated);

        return redirect()->route('pengurus.index')->with('success', 'Data pengurus berhasil ditambahkan.');
    }

    public function edit(Pengurus $pengurus)
    {
        return view('pengurus.edit', compact('pengurus'));
    }

    public function update(Request $request, Pengurus $pengurus)
    {
        $validated = $request->validate([
            // ... field Detail Pengurus yang sudah ada
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat_domisili' => 'required|string',
            'status_menikah' => 'required|in:Menikah,Belum Menikah',
            'pekerjaan' => 'nullable|string|max:255',

            // Field Pendidikan (baru)
            'sd_sederajat' => 'nullable|string|max:255',
            'sd_tahun_lulus' => 'nullable|digits:4|integer',
            'smp_sederajat' => 'nullable|string|max:255',
            'smp_tahun_lulus' => 'nullable|digits:4|integer',
            'sma_sederajat' => 'nullable|string|max:255',
            'sma_tahun_lulus' => 'nullable|digits:4|integer',
            'pondok_pesantren' => 'nullable|string|max:255',
            's1' => 'nullable|string|max:255',
            's2' => 'nullable|string|max:255',
            's3' => 'nullable|string|max:255',
            'pengkaderan_fatayat' => 'nullable|string|max:255',
            'pengkaderan_nu' => 'nullable|string|max:255',
            'pengalaman_organisasi' => 'nullable|string',
            'jabatan' => 'nullable|string|max:255',
            'asal_pr' => 'nullable|string|max:255',
            'asal_par' => 'nullable|string|max:255',
            'pelatihan' => 'nullable|string',
            'potensi' => 'nullable|string',
            'produk_usaha' => 'nullable|string',
            'prestasi' => 'nullable|string',
            'foto_ktp' => 'nullable|image|max:2048',
            'foto_seragam' => 'nullable|image|max:2048',
            'sertifikat_pengkaderan' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('foto_ktp')) {
            if ($pengurus->foto_ktp) {
                Storage::disk('public')->delete($pengurus->foto_ktp);
            }
            $validated['foto_ktp'] = $request->file('foto_ktp')->store('pengurus/ktp', 'public');
        }

        if ($request->hasFile('foto_seragam')) {
            if ($pengurus->foto_seragam) {
                Storage::disk('public')->delete($pengurus->foto_seragam);
            }
            $validated['foto_seragam'] = $request->file('foto_seragam')->store('pengurus/seragam', 'public');
        }

        if ($request->hasFile('sertifikat_pengkaderan')) {
            if ($pengurus->sertifikat_pengkaderan) {
                Storage::disk('public')->delete($pengurus->sertifikat_pengkaderan);
            }
            $validated['sertifikat_pengkaderan'] = $request->file('sertifikat_pengkaderan')->store('pengurus/sertifikat', 'public');
        }

        $pengurus->update($validated);

        return redirect()->route('pengurus.index')->with('success', 'Data pengurus berhasil diperbarui.');
    }

    public function destroy(Pengurus $pengurus)
    {
        $pengurus->delete();

        return redirect()->route('pengurus.index')->with('success', 'Data pengurus berhasil dihapus.');
    }
}
