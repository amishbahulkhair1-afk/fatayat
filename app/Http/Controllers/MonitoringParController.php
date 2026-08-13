<?php

namespace App\Http\Controllers;

use App\Models\Par;
use Illuminate\Http\Request;

class MonitoringParController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $baseQuery = Par::query();
        if ($user->role === 'admin_pr') {
            $baseQuery->where('pr_id', $user->pr_id);
        }

        $ringkasan = [
            'total' => (clone $baseQuery)->count(),
            'aktif' => (clone $baseQuery)->where('status', 'Aktif')->count(),
            'tidak_aktif' => (clone $baseQuery)->where('status', '!=', 'Aktif')->count(),
        ];

        $query = (clone $baseQuery)->with(['pr', 'ketua']);
        if ($request->filled('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $par = $query->latest()->paginate(10)->withQueryString();

        return view('monitoring.par', compact('par', 'ringkasan'));
    }
}