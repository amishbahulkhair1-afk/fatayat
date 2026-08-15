<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index(Request $request)
    {
        $notifikasi = $request->user()->notifications()->latest()->paginate(15);
        $request->user()->unreadNotifications->markAsRead();

        return view('notifikasi.index', compact('notifikasi'));
    }
}
