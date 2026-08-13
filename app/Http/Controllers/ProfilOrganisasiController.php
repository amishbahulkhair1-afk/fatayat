<?php

namespace App\Http\Controllers;

use App\Models\ProfilOrganisasi;
use App\Models\MisiOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilOrganisasiController extends Controller
{
    // Ambil profil yang sudah ada, atau bikin baru kalau belum pernah ada (singleton pattern)
    private function getProfil()
    {
        return ProfilOrganisasi::first() ?? ProfilOrganisasi::create([]);
    }

    public function sejarah()
    {
        $profil = $this->getProfil();
        return view('profil-organisasi.sejarah', compact('profil'));
    }

    public function updateSejarah(Request $request)
    {
        $validated = $request->validate([
            'judul_utama' => 'required|string|max:255',
            'sub_judul' => 'nullable|string|max:255',
            'gambar_sampul' => 'nullable|image|max:2048',
            'konten_sejarah' => 'nullable|string',
        ]);

        $profil = $this->getProfil();

        if ($request->hasFile('gambar_sampul')) {
            if ($profil->gambar_sampul) {
                Storage::disk('public')->delete($profil->gambar_sampul);
            }
            $validated['gambar_sampul'] = $request->file('gambar_sampul')->store('profil/sampul', 'public');
        }

        $profil->update($validated);

        return redirect()->route('profil-organisasi.sejarah')->with('success', 'Sejarah berhasil diperbarui.');
    }

    public function visiMisi()
    {
        $profil = $this->getProfil();
        $profil->load('misi');
        return view('profil-organisasi.visi-misi', compact('profil'));
    }

    public function updateVisiMisi(Request $request)
    {
        $validated = $request->validate([
            'visi' => 'nullable|string|max:500',
            'misi' => 'nullable|array',
            'misi.*.id' => 'nullable|exists:misi_organisasi,id',
            'misi.*.isi_misi' => 'required|string',
        ]);

        $profil = $this->getProfil();
        $profil->update(['visi' => $validated['visi'] ?? null]);

        $idDikirim = [];

        foreach ($validated['misi'] ?? [] as $index => $item) {
            $misi = MisiOrganisasi::updateOrCreate(
                ['id' => $item['id'] ?? null, 'profil_organisasi_id' => $profil->id],
                ['isi_misi' => $item['isi_misi'], 'urutan' => $index]
            );
            $idDikirim[] = $misi->id;
        }

        // Hapus misi yang tidak lagi dikirim (berarti dihapus user lewat tombol hapus)
        MisiOrganisasi::where('profil_organisasi_id', $profil->id)
            ->whereNotIn('id', $idDikirim)
            ->delete();

        return redirect()->route('profil-organisasi.visi-misi')->with('success', 'Visi & Misi berhasil diperbarui.');
    }

    public function struktur()
    {
        $profil = $this->getProfil();
        return view('profil-organisasi.struktur', compact('profil'));
    }

    public function updateStruktur(Request $request)
    {
        $validated = $request->validate([
            'foto_struktur' => 'required|image|max:2048',
        ]);

        $profil = $this->getProfil();

        if ($profil->foto_struktur) {
            Storage::disk('public')->delete($profil->foto_struktur);
        }
        $validated['foto_struktur'] = $request->file('foto_struktur')->store('profil/struktur', 'public');

        $profil->update($validated);

        return redirect()->route('profil-organisasi.struktur')->with('success', 'Struktur kepengurusan berhasil diperbarui.');
    }
}