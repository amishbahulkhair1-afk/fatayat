<?php

namespace App\Http\Controllers;

use App\Models\Pr;
use App\Models\Anggota;
use Illuminate\Http\Request;

class MonitoringAnggotaController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Pr::with('pars');

        if ($user->role === 'admin_pr') {
            $query->where('id', $user->pr_id);
        }

        if ($request->filled('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%');
        }

        $prList = $query->get()->map(function ($pr) {
            $parIds = $pr->pars->pluck('id');

            $anggotaIds = Anggota::where(function ($q) use ($pr, $parIds) {
                $q->where('pr_id', $pr->id)->orWhereIn('par_id', $parIds);
            })->pluck('id');

            $totalAnggota = $anggotaIds->count();
            $totalKader = Anggota::whereIn('id', $anggotaIds)->has('riwayatKaderisasi')->count();
            $kaderAktif = Anggota::whereIn('id', $anggotaIds)->has('riwayatKaderisasi')->where('status_anggota', 'Aktif')->count();

            $pr->jumlah_par = $pr->pars->count();
            $pr->total_anggota = $totalAnggota;
            $pr->total_kader = $totalKader;
            $pr->kader_aktif = $kaderAktif;
            $pr->kader_tidak_aktif = $totalKader - $kaderAktif;

            return $pr;
        });

        $ringkasan = [
            'jumlah_pr' => $prList->count(),
            'jumlah_par' => $prList->sum('jumlah_par'),
            'total_kader' => $prList->sum('total_kader'),
            'kader_aktif' => $prList->sum('kader_aktif'),
            'total_anggota' => $prList->sum('total_anggota'),
        ];

        return view('monitoring.anggota', compact('prList', 'ringkasan'));
    }
}