@extends('layouts.userapp')

@section('title', 'Pengaduan Terkirim - Fatayat NU PAC Pragaan')

@include('pengaduan-publik._styles')

@section('content')
    <section class="complaint-page">
        <div class="complaint-shell" style="max-width: 620px;">
            <div class="complaint-card" style="text-align: center;">
                <div class="complaint-icon"><i class="fa-solid fa-check"></i></div>
                <h1 class="complaint-card-title">Pengaduan berhasil dikirim</h1>
                <p class="complaint-card-intro">Simpan nomor berikut untuk memantau status dan tanggapan atas laporan Anda.</p>
                <div class="complaint-number">{{ $noPengaduan }}</div>
                <div class="complaint-actions">
                    <a href="{{ route('pengaduan.publik.cek') }}" class="complaint-button"><i class="fa-solid fa-magnifying-glass"></i> Cek Status</a>
                    <a href="{{ route('pengaduan.publik.create') }}" class="complaint-link">Buat Pengaduan Lain</a>
                </div>
            </div>
        </div>
    </section>
@endsection
