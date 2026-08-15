@extends('layouts.userapp')

@section('title', 'Cek Status Pengaduan - Fatayat NU PAC Pragaan')

@include('pengaduan-publik._styles')

@section('content')
    <section class="complaint-page">
        <div class="complaint-shell">
            <div class="complaint-hero">
                <span class="complaint-kicker"><i class="fa-solid fa-magnifying-glass"></i> Layanan Publik</span>
                <h1>Cek Status Pengaduan</h1>
                <p>Masukkan nomor laporan Anda untuk melihat perkembangan penanganannya.</p>
            </div>
            <div class="complaint-card">
                <div class="complaint-icon"><i class="fa-solid fa-file-circle-check"></i></div>
                <h2 class="complaint-card-title">Lacak laporan Anda</h2>
                <p class="complaint-card-intro">Nomor pengaduan diberikan setelah laporan berhasil dikirim.</p>
                <form action="{{ route('pengaduan.publik.cari') }}" method="POST">
                    @csrf
                    <div class="complaint-field">
                        <label for="no_pengaduan">Nomor Pengaduan</label>
                        <input type="text" name="no_pengaduan" value="{{ old('no_pengaduan') }}" id="no_pengaduan"
                            placeholder="Contoh: PGD-2026-0001" class="complaint-input" autocomplete="off">
                        @error('no_pengaduan') <p class="complaint-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="complaint-actions">
                        <a href="{{ route('pengaduan.publik.create') }}" class="complaint-link">Buat Pengaduan</a>
                        <button type="submit" class="complaint-button"><i class="fa-solid fa-magnifying-glass"></i> Cek Status</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
