@extends('layouts.userapp')

@section('title', ($profil?->judul_utama ?? 'Profil Organisasi') . ' - Fatayat NU PAC Pragaan')

@push('styles')
    <style>
        .org-profile { padding: 42px 20px 88px; background: linear-gradient(180deg, #edf7ef 0, #f8faf9 420px); }.org-wrap { width: min(100%, 1120px); margin: auto; }.org-hero { position: relative; display: grid; min-height: 340px; grid-template-columns: 1.05fr .95fr; overflow: hidden; border-radius: 30px; background: var(--green-dark); box-shadow: 0 22px 55px rgba(7,91,56,.18); }.org-hero-copy { position: relative; z-index: 1; padding: clamp(28px, 4.5vw, 50px); color: #fff; }.org-kicker { display: inline-flex; align-items: center; gap: 8px; padding: 7px 12px; border: 1px solid rgba(255,255,255,.2); border-radius: 999px; background: rgba(255,255,255,.1); font-size: 11px; font-weight: 800; }.org-hero h1 { max-width: 580px; margin: 14px 0 10px; font: 800 clamp(1.8rem, 4vw, 2.8rem)/1.14 'Playfair Display', serif; }.org-hero p { max-width: 520px; color: rgba(255,255,255,.85); font-size: .94rem; line-height: 1.65; }.org-hero-image { min-height: 240px; background: linear-gradient(135deg, #9fc9a7, #3d8154); }.org-hero-image img { width: 100%; height: 100%; object-fit: cover; }.org-hero-image .org-image-placeholder { display: grid; height: 100%; place-items: center; color: rgba(255,255,255,.82); font-size: 44px; }.org-section { padding-top: 68px; }.org-heading { max-width: 700px; margin-bottom: 28px; }.org-heading span { color: var(--green); font-size: 12px; font-weight: 800; letter-spacing: .06em; text-transform: uppercase; }.org-heading h2 { margin: 8px 0; color: var(--green-dark); font: 800 clamp(1.7rem, 4vw, 2.5rem)/1.2 'Playfair Display', serif; }.org-heading p { color: var(--muted); }.org-story { display: grid; grid-template-columns: 1.05fr .95fr; gap: 26px; align-items: start; }.org-panel { padding: clamp(24px, 4vw, 38px); border: 1px solid var(--border); border-radius: 22px; background: #fff; box-shadow: 0 13px 32px rgba(7,91,56,.07); }.org-story-text { color: #435047; line-height: 1.85; white-space: pre-line; }.org-vision { position: sticky; top: 100px; background: linear-gradient(135deg, var(--green-dark), var(--green)); color: #fff; }.org-vision .org-label { color: #dcefe0; font-size: 12px; font-weight: 800; text-transform: uppercase; }.org-vision blockquote { margin-top: 14px; font: 700 clamp(1.35rem, 3vw, 1.9rem)/1.45 'Playfair Display', serif; }.org-mission-section { margin-top: 32px; }.org-mission-section .org-heading { margin-bottom: 20px; }.org-mission-section .org-heading h2 { font-size: clamp(1.45rem, 3vw, 1.9rem); }.org-mission-grid { display: grid; grid-template-columns: 1fr; gap: 14px; }.org-mission { display: flex; gap: 13px; padding: 19px; border: 1px solid #dfece2; border-radius: 17px; background: #fff; }.org-mission-number { display: grid; flex: 0 0 32px; height: 32px; place-items: center; border-radius: 50%; background: var(--green-light); color: var(--green-dark); font-size: 12px; font-weight: 800; }.org-mission p { color: #48554c; font-size: 14px; line-height: 1.65; }.org-structure { overflow: hidden; border: 1px solid var(--border); border-radius: 24px; background: #fff; box-shadow: 0 13px 32px rgba(7,91,56,.07); }.org-structure img { width: 100%; max-height: 700px; object-fit: contain; background: #f5faf6; }.org-empty-structure { padding: 55px 24px; color: var(--muted); text-align: center; }.org-empty-structure i { display: block; margin-bottom: 12px; color: var(--green); font-size: 35px; }.org-return { display: inline-flex; align-items: center; gap: 8px; margin-top: 36px; padding: 13px 18px; border-radius: 12px; background: var(--green-light); color: var(--green-dark); font-size: 13px; font-weight: 800; }.org-return:hover { background: #d8efe1; }
        @media (max-width: 780px) { .org-hero, .org-story { grid-template-columns: 1fr; }.org-hero-image { min-height: 240px; order: -1; }.org-vision { position: static; }.org-mission-grid { grid-template-columns: 1fr; } } @media (max-width: 520px) { .org-profile { padding: 25px 14px 60px; }.org-hero { border-radius: 22px; }.org-hero-copy { padding: 30px 25px 38px; }.org-section { padding-top: 50px; } }
    </style>
@endpush

@section('content')
    <main class="org-profile">
        <div class="org-wrap">
            <section class="org-hero">
                <div class="org-hero-copy">
                    <span class="org-kicker"><i class="fa-solid fa-building"></i> Profil Organisasi</span>
                    <h1>{{ $profil?->judul_utama ?? 'Fatayat NU PAC Pragaan' }}</h1>
                    <p>{{ $profil?->sub_judul ?? 'Ruang tumbuh perempuan muda Nahdlatul Ulama untuk bergerak, mengabdi, dan memberi manfaat bagi masyarakat.' }}</p>
                </div>
                <div class="org-hero-image">
                    @if ($profil?->gambar_sampul)
                        <img src="{{ Storage::url($profil->gambar_sampul) }}" alt="{{ $profil->judul_utama }}">
                    @else
                        <div class="org-image-placeholder"><i class="fa-solid fa-seedling"></i></div>
                    @endif
                </div>
            </section>

            <section class="org-section">
                <div class="org-heading"><span>Sejarah</span><h2>Perjalanan organisasi</h2><p>Sejarah dan semangat yang menjadi pijakan gerakan kami.</p></div>
                <div class="org-story">
                    <div>
                        <div class="org-panel org-story-text">{{ $profil?->konten_sejarah ?? 'Informasi sejarah organisasi akan ditampilkan di sini setelah diperbarui oleh pengelola.' }}</div>
                        <div class="org-mission-section">
                            <div class="org-heading"><span>Arah Gerak</span><h2>Misi organisasi</h2><p>Komitmen yang diterjemahkan dalam langkah nyata dan pelayanan untuk masyarakat.</p></div>
                            <div class="org-mission-grid">
                                @forelse ($profil?->misi ?? [] as $nomor => $misi)
                                    <article class="org-mission"><span class="org-mission-number">{{ str_pad($nomor + 1, 2, '0', STR_PAD_LEFT) }}</span><p>{{ $misi->isi_misi }}</p></article>
                                @empty
                                    <article class="org-mission"><span class="org-mission-number">01</span><p>Informasi misi organisasi akan ditampilkan setelah diperbarui oleh pengelola.</p></article>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="org-panel org-vision"><p class="org-label">Visi Organisasi</p><blockquote>“{{ $profil?->visi ?? 'Menjadi organisasi perempuan muda yang berdaya, berakhlak, dan bermanfaat bagi masyarakat.' }}”</blockquote></div>
                </div>
            </section>

            <section class="org-section">
                <div class="org-heading"><span>Kepengurusan</span><h2>Struktur organisasi</h2><p>Struktur kepengurusan Fatayat NU PAC Pragaan.</p></div>
                <div class="org-structure">
                    @if ($profil?->foto_struktur)
                        <img src="{{ Storage::url($profil->foto_struktur) }}" alt="Struktur Kepengurusan {{ $profil->judul_utama }}">
                    @else
                        <div class="org-empty-structure"><i class="fa-solid fa-sitemap"></i>Struktur kepengurusan belum tersedia.</div>
                    @endif
                </div>
                <a href="{{ url('/') }}" class="org-return"><i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda</a>
            </section>
        </div>
    </main>
@endsection
