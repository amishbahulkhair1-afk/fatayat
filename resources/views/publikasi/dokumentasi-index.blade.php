@extends('layouts.userapp')

@section('title', 'Dokumentasi Kegiatan - Fatayat NU PAC Pragaan')

@include('publikasi._styles')

@section('content')
    <section class="publication-page">
        <div class="publication-container">
            <header class="publication-intro">
                <span class="publication-kicker"><i class="fa-solid fa-images"></i> Galeri Organisasi</span>
                <h1>Dokumentasi Kegiatan</h1>
                <p>Rekam jejak kegiatan, kaderisasi, pengajian, dan pengabdian Fatayat NU PAC Pragaan.</p>
            </header>
            <div class="gallery-grid">
                @forelse ($dokumentasi as $item)
                    <article class="gallery-card">
                        <div class="publication-media">
                            @if ($item->foto)
                                <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->judul_dokumentasi }}">
                            @else <div class="publication-placeholder"><i class="fa-solid fa-camera"></i></div> @endif
                        </div>
                        <div class="gallery-card-body">
                            <p class="publication-meta">{{ $item->kategori }}</p>
                            <h2>{{ $item->judul_dokumentasi }}</h2>
                            <p class="gallery-date">{{ \Illuminate\Support\Carbon::parse($item->tanggal_kegiatan)->translatedFormat('d M Y') }}</p>
                        </div>
                    </article>
                @empty
                    <div class="publication-empty"><i class="fa-regular fa-images"></i>Belum ada dokumentasi yang dipublikasikan.</div>
                @endforelse
            </div>
            <div class="publication-pagination">{{ $dokumentasi->links() }}</div>
        </div>
    </section>
@endsection
