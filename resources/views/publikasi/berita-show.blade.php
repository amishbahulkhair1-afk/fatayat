@extends('layouts.userapp')

@section('title', $berita->judul . ' - Fatayat NU PAC Pragaan')

@include('publikasi._styles')

@section('content')
    <section class="publication-page">
        <div class="article-shell">
            <a href="{{ route('berita.publik.index') }}" class="article-back"><i class="fa-solid fa-arrow-left"></i> Kembali ke daftar berita</a>
            <article class="article-card">
                <div class="publication-media">
                    @if ($berita->gambar_utama)
                        <img src="{{ Storage::url($berita->gambar_utama) }}" alt="{{ $berita->judul }}">
                    @else <div class="publication-placeholder"><i class="fa-solid fa-newspaper"></i></div> @endif
                </div>
                <div class="article-body">
                    <p class="publication-meta">{{ $berita->kategori }} · {{ \Illuminate\Support\Carbon::parse($berita->tanggal_kegiatan)->translatedFormat('d F Y') }}</p>
                    <h1 class="article-title">{{ $berita->judul }}</h1>
                    <p class="article-byline">Oleh {{ $berita->penulis }}@if ($berita->lokasi) <span> · {{ $berita->lokasi }}</span> @endif</p>
                    <div class="article-content">{{ $berita->isi_berita }}</div>
                </div>
            </article>
        </div>
    </section>
@endsection
