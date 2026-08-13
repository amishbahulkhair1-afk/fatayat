<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use Illuminate\Http\Request;

class MonitoringLembagaController extends Controller
{
    public function index(Request $request)
    {
        $query = Lembaga::withCount([
            'programKerja as total_program_kerja',
            'programKerja as proker_selesai' => fn($q) => $q->where('status', 'Selesai'),
            'kegiatan as total_kegiatan',
            'kegiatan as kegiatan_selesai' => fn($q) => $q->where('status_kegiatan', 'Selesai'),
        ]);

        if ($request->filled('cari')) {
            $query->where('nama_lembaga', 'like', '%' . $request->cari . '%');
        }

        $lembaga = $query->get();

        $ringkasan = [
            'total_lembaga' => $lembaga->count(),
            'total_program_kerja' => $lembaga->sum('total_program_kerja'),
            'proker_selesai' => $lembaga->sum('proker_selesai'),
            'proker_tidak' => $lembaga->sum('total_program_kerja') - $lembaga->sum('proker_selesai'),
            'kegiatan_selesai' => $lembaga->sum('kegiatan_selesai'),
            'kegiatan_tidak' => $lembaga->sum('total_kegiatan') - $lembaga->sum('kegiatan_selesai'),
        ];

        return view('monitoring.lembaga', compact('lembaga', 'ringkasan'));
    }
}