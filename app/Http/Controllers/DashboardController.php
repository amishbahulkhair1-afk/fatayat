<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Pr;
use App\Models\Par;
use App\Models\Anggota;
use App\Models\Lembaga;
use App\Models\Kegiatan;
use App\Models\Pengaduan;

class DashboardController extends Controller
{
    public function pac()
    {
        $ringkasan = [
            'total_pengurus' => Pengurus::count(),
            'total_pr' => Pr::count(),
            'total_par' => Par::count(),
            'total_anggota' => Anggota::count(),
            'total_lembaga' => Lembaga::count(),
            'pengaduan_baru' => Pengaduan::where('status', 'Baru')->count(),
        ];

        $kegiatanMendatang = Kegiatan::where('tanggal_kegiatan', '>=', now())
            ->orderBy('tanggal_kegiatan')
            ->take(5)
            ->get();

        return view('dashboard-pac', compact('ringkasan', 'kegiatanMendatang'));
    }

    public function pr()
    {
        $user = auth()->user();

        $totalPar = Par::where('pr_id', $user->pr_id)->count();
        $parIds = Par::where('pr_id', $user->pr_id)->pluck('id');
        $totalAnggota = Anggota::where('pr_id', $user->pr_id)->orWhereIn('par_id', $parIds)->count();

        $ringkasan = [
            'total_par' => $totalPar,
            'total_anggota' => $totalAnggota,
        ];

        return view('dashboard-pr', compact('ringkasan'));
    }

    public function par()
    {
        $user = auth()->user();

        $ringkasan = [
            'total_anggota' => Anggota::where('par_id', $user->par_id)->count(),
            'anggota_aktif' => Anggota::where('par_id', $user->par_id)->where('status_anggota', 'Aktif')->count(),
            'anggota_tidak_aktif' => Anggota::where('par_id', $user->par_id)->where('status_anggota', '!=', 'Aktif')->count(),
        ];

        return view('dashboard-par', compact('ringkasan'));
    }
}