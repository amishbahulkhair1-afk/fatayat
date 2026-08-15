@extends('layouts.userapp')

@section('title', 'Berita Kegiatan - Fatayat NU PAC Pragaan')

@include('publikasi._styles')

@section('content')
    <section class="publication-page">
        <div class="publication-container">
            <header class="publication-intro">
                <span class="publication-kicker"><i class="fa-solid fa-newspaper"></i> Publikasi Organisasi</span>
                <h1>Berita & Kegiatan</h1>
                <p>Ikuti kabar terbaru, kegiatan, dan langkah pengabdian Fatayat NU PAC Pragaan.</p>
            </header>
            <div class="publication-grid">
                @forelse ($berita as $item)
                    <a href="{{ route('berita.publik.show', $item) }}" class="publication-card">
                        <div class="publication-media">
                            @if ($item->gambar_utama)
                                <img src="{{ Storage::url($item->gambar_utama) }}" alt="{{ $item->judul }}">
                            @else <div class="publication-placeholder"><i class="fa-solid fa-image"></i></div> @endif
                        </div>
                        <div class="publication-card-body">
                            <p class="publication-meta">{{ $item->kategori }} · {{ \Illuminate\Support\Carbon::parse($item->tanggal_kegiatan)->translatedFormat('d M Y') }}</p>
                            <h2>{{ $item->judul }}</h2>
                            <p class="publication-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($item->isi_berita), 115) }}</p>
                            <span class="publication-read">Baca selengkapnya <i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                    </a>
                @empty
                    <div class="publication-empty"><i class="fa-regular fa-newspaper"></i>Belum ada berita yang dipublikasikan.</div>
                @endforelse
            </div>
            <div class="publication-pagination">{{ $berita->links() }}</div>
        </div>
    </section>
@endsection
