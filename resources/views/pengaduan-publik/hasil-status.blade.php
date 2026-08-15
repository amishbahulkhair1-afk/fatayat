@extends('layouts.userapp')

@section('title', 'Status Pengaduan - Fatayat NU PAC Pragaan')

@include('pengaduan-publik._styles')

@section('content')
    <section class="complaint-page">
        <div class="complaint-shell" style="max-width: 680px;">
            <div class="complaint-hero">
                <span class="complaint-kicker"><i class="fa-solid fa-clock-rotate-left"></i> Layanan Publik</span>
                <h1>Status Pengaduan</h1>
                <p>Berikut perkembangan terbaru dari laporan yang Anda ajukan.</p>
            </div>
            <div class="complaint-card">
                <div class="complaint-icon"><i class="fa-solid fa-clipboard-check"></i></div>
                <h2 class="complaint-card-title">Detail laporan</h2>
                <div class="complaint-details">
                    <div class="complaint-detail"><small>Nomor Pengaduan</small><strong>{{ $pengaduan->no_pengaduan }}</strong></div>
                    <div class="complaint-detail"><small>Status Saat Ini</small><span class="complaint-status status-{{ strtolower($pengaduan->status) }}">{{ $pengaduan->status }}</span></div>
                    <div class="complaint-detail"><small>Tanggal Diajukan</small><strong>{{ \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->translatedFormat('d F Y') }}</strong></div>
                </div>
                @if ($pengaduan->tanggapan_admin)
                    <div class="complaint-response"><strong>Tanggapan dari Admin</strong><br>{{ $pengaduan->tanggapan_admin }}</div>
                @else
                    <p class="complaint-card-intro" style="margin:0;">Belum ada tanggapan dari admin. Silakan cek kembali secara berkala.</p>
                @endif
                <div class="complaint-actions"><a href="{{ route('pengaduan.publik.cek') }}" class="complaint-link"><i class="fa-solid fa-magnifying-glass"></i> Cek Nomor Lain</a></div>
            </div>
        </div>
    </section>
@endsection
