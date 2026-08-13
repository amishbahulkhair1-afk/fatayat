<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Notulen;
use App\Models\BukuTamu;
use App\Models\Inventaris;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        $ringkasan = [
            'total_anggota' => Anggota::count(),
            'total_notulen' => Notulen::count(),
            'total_buku_tamu' => BukuTamu::count(),
            'total_inventaris' => Inventaris::count(),
        ];

        return view('laporan.index', compact('ringkasan'));
    }

    // ===== LAPORAN ANGGOTA =====
    public function anggota(Request $request)
    {
        $data = $this->filterAnggota($request)->paginate(15)->withQueryString();
        return view('laporan.anggota', compact('data'));
    }

    public function anggotaPdf(Request $request)
    {
        $data = $this->filterAnggota($request)->get();
        $pdf = Pdf::loadView('laporan.pdf.anggota', compact('data'));
        return $pdf->download('laporan-anggota.pdf');
    }
    private function filterAnggota(Request $request)
    {
        $user = auth()->user();
        $query = Anggota::with(['pr', 'par']);

        if ($user->role === 'admin_par') {
            $query->where('par_id', $user->par_id);
        } elseif ($user->role === 'admin_pr') {
            $parIds = \App\Models\Par::where('pr_id', $user->pr_id)->pluck('id');
            $query->where(function ($q) use ($user, $parIds) {
                $q->where('pr_id', $user->pr_id)->orWhereIn('par_id', $parIds);
            });
        }

        if ($request->filled('status_anggota')) {
            $query->where('status_anggota', $request->status_anggota);
        }

        return $query->latest();
    }

    // ===== LAPORAN NOTULEN =====
    public function notulen(Request $request)
    {
        $data = $this->filterNotulen($request)->paginate(15)->withQueryString();
        return view('laporan.notulen', compact('data'));
    }

    public function notulenPdf(Request $request)
    {
        $data = $this->filterNotulen($request)->get();
        $pdf = Pdf::loadView('laporan.pdf.notulen', compact('data'));
        return $pdf->download('laporan-notulen.pdf');
    }

    private function filterNotulen(Request $request)
    {
        $query = Notulen::query();
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }
        return $query->latest('tanggal');
    }

    // ===== LAPORAN BUKU TAMU =====
    public function bukuTamu(Request $request)
    {
        $data = $this->filterBukuTamu($request)->paginate(15)->withQueryString();
        return view('laporan.buku-tamu', compact('data'));
    }

    public function bukuTamuPdf(Request $request)
    {
        $data = $this->filterBukuTamu($request)->get();
        $pdf = Pdf::loadView('laporan.pdf.buku-tamu', compact('data'));
        return $pdf->download('laporan-buku-tamu.pdf');
    }

    private function filterBukuTamu(Request $request)
    {
        $query = BukuTamu::query();
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_kunjungan', $request->bulan);
        }
        return $query->latest('tanggal_kunjungan');
    }

    // ===== LAPORAN INVENTARIS =====
    public function inventaris(Request $request)
    {
        $data = $this->filterInventaris($request)->paginate(15)->withQueryString();
        return view('laporan.inventaris', compact('data'));
    }

    public function inventarisPdf(Request $request)
    {
        $data = $this->filterInventaris($request)->get();
        $pdf = Pdf::loadView('laporan.pdf.inventaris', compact('data'));
        return $pdf->download('laporan-inventaris.pdf');
    }

    private function filterInventaris(Request $request)
    {
        $query = Inventaris::query();
        if ($request->filled('nama_barang')) {
            $query->where('nama_barang', 'like', '%' . $request->nama_barang . '%');
        }
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }
        if ($request->filled('satuan')) {
            $query->where('satuan', $request->satuan);
        }
        return $query->latest();
    }
}