@php
    $profil = $profil ?? null;
    $profilOrganisasi = $profilOrganisasi ?? null;
    $misiOrganisasi = $misiOrganisasi ?? collect();
    $beritaTerbaru = $beritaTerbaru ?? collect();
    $dokumentasiPublik = $dokumentasiPublik ?? collect();
@endphp

@extends('layouts.userapp')

@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #2f6f3e;
            --primary-dark: #1f4d2b;
            --primary-light: #d9ead7;
            --accent: #f4f7ef;
            --text: #1f2937;
            --muted: #6b7280;
            --white: #ffffff;
            --shadow: 0 15px 40px rgba(31, 77, 43, 0.12);
            --radius: 28px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, #6f8f69 0%, #f4f7ef 240px, #eef4e8 100%);
            color: var(--text);
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            width: 100%;
            display: block;
        }

        .container {
            width: min(1200px, calc(100% - 32px));
            margin: 0 auto;
        }

        /* ================= HERO ================= */
        .hero {
            position: relative;
            border-radius: 40px;
            overflow: hidden;
            min-height: 620px;
            display: flex;
            align-items: flex-end;
            background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
            box-shadow: var(--shadow);
            isolation: isolate;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(12, 26, 16, 0.78) 0%, rgba(12, 26, 16, 0.42) 45%, rgba(12, 26, 16, 0.12) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 72px 64px 120px;
            max-width: 560px;
            color: var(--white);
        }

        .hero::after {
            content: '';
            position: absolute;
            width: 360px;
            height: 360px;
            right: -110px;
            bottom: -170px;
            border-radius: 50%;
            background: rgba(217, 234, 215, .17);
            border: 1px solid rgba(255, 255, 255, .2);
        }

        .hero-section {
            width: calc(100% - 60px);
            max-width: 1800px;

            min-height: 500px;

            margin: 0 auto;

            border-radius: 38px;

            overflow: hidden;

            position: relative;

            background:
                linear-gradient(90deg,
                    rgba(25, 65, 43, .92),
                    rgba(25, 65, 43, .45),
                    rgba(25, 65, 43, .15));

            box-shadow: 0 25px 60px rgba(0, 0, 0, .12);
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(8px);
            padding: 10px 18px;
            border-radius: 999px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 22px;
        }

        .hero h1 {
            font-size: clamp(2.5rem, 5vw, 4.5rem);
            line-height: 1.05;
            margin-bottom: 20px;
            font-weight: 800;
        }

        .hero p {
            font-size: 1.05rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 28px;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
        }

        .hero-highlights {
            display: flex;
            gap: 24px;
            margin-top: 38px;
            padding-top: 22px;
            border-top: 1px solid rgba(255, 255, 255, .25);
        }

        .hero-highlight strong {
            display: block;
            font-size: 1.15rem;
            line-height: 1.2;
        }

        .hero-highlight span {
            color: rgba(255, 255, 255, .76);
            font-size: .78rem;
        }

        .btn-primary,
        .btn-secondary {
            padding: 14px 26px;
            border-radius: 999px;
            font-weight: 600;
            transition: transform .3s ease, box-shadow .3s ease, background .3s ease;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
            box-shadow: 0 10px 24px rgba(31, 77, 43, 0.25);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.16);
            color: var(--white);
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(6px);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.24);
            transform: translateY(-3px);
        }

        /* ================= SEARCH BAR ================= */
        .search-bar-wrapper {
            margin-top: -52px;
            position: relative;
            z-index: 10;
        }

        .search-bar {
            background: #d5e6cf;
            border-radius: 999px;
            padding: 16px;
            box-shadow: var(--shadow);
        }

        .search-inner {
            background: var(--white);
            border-radius: 999px;
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 18px;
            flex-wrap: wrap;
        }

        .search-item {
            flex: 1;
            min-width: 170px;
            padding: 0 8px;
        }

        .search-item label {
            display: block;
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--muted);
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .search-item input {
            width: 100%;
            border: none;
            outline: none;
            font-size: 0.95rem;
            color: var(--text);
        }

        .search-button {
            background: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 999px;
            padding: 14px 26px;
            font-weight: 600;
            cursor: pointer;
            transition: background .3s ease, transform .3s ease;
        }

        .search-button:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        /* ================= SECTION ================= */
        section {
            padding: 88px 0;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 36px;
            flex-wrap: wrap;
        }

        .section-header h2 {
            font-size: clamp(2rem, 4vw, 2.9rem);
            color: var(--primary-dark);
            margin-bottom: 10px;
        }

        .section-header p {
            color: var(--muted);
            max-width: 560px;
        }

        /* ================= ABOUT ================= */
        .about-grid {
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            gap: 34px;
            align-items: center;
        }

        .about-image {
            position: relative;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .about-image img {
            height: 100%;
            min-height: 360px;
            object-fit: cover;
        }

        .about-badge {
            position: absolute;
            left: 22px;
            top: 22px;
            background: var(--primary);
            color: var(--white);
            padding: 16px 18px;
            border-radius: 22px;
            font-weight: 700;
            font-size: 0.95rem;
            box-shadow: 0 12px 28px rgba(31, 77, 43, 0.28);
        }

        .about-content h3 {
            font-size: 1.8rem;
            margin-bottom: 16px;
            color: var(--primary-dark);
        }

        .about-content p {
            color: var(--muted);
            margin-bottom: 22px;
        }

        .mission-list {
            display: grid;
            gap: 12px;
            margin-bottom: 24px;
        }

        .mission-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            background: rgba(217, 234, 215, 0.55);
            padding: 14px 16px;
            border-radius: 18px;
        }

        .mission-icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--primary);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        /* ================= CARDS ================= */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .card {
            background: var(--white);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform .35s ease, box-shadow .35s ease;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 22px 44px rgba(31, 77, 43, 0.16);
        }

        .card-image {
            height: 230px;
            overflow: hidden;
        }

        .card-image img {
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .card:hover .card-image img {
            transform: scale(1.05);
        }

        .card-body {
            padding: 24px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-body h3 {
            font-size: 1.25rem;
            margin-bottom: 12px;
            color: var(--primary-dark);
        }

        .card-body p {
            color: var(--muted);
            font-size: 0.95rem;
            margin-bottom: 20px;
            flex: 1;
        }

        .card-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary);
            color: var(--white);
            padding: 12px 18px;
            border-radius: 999px;
            font-weight: 600;
            width: fit-content;
            transition: background .3s ease;
        }

        .card-link:hover {
            background: var(--primary-dark);
        }

        /* ================= SERVICES ================= */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 22px;
        }

        .service-card {
            background: var(--white);
            border-radius: 24px;
            padding: 28px;
            box-shadow: var(--shadow);
            transition: transform .3s ease;
        }

        .service-card:hover {
            transform: translateY(-6px);
        }

        .service-icon {
            width: 62px;
            height: 62px;
            border-radius: 18px;
            background: var(--primary-light);
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 18px;
        }

        .service-card h3 {
            margin-bottom: 10px;
            color: var(--primary-dark);
        }

        .service-card p {
            color: var(--muted);
            font-size: 0.92rem;
        }

        /* ================= CONTACT ================= */
        .contact-section {
            padding-bottom: 100px;
        }

        .contact-box {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            border-radius: 36px;
            padding: 48px;
            color: var(--white);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 36px;
            box-shadow: var(--shadow);
        }

        .contact-box h2 {
            font-size: 2.2rem;
            margin-bottom: 16px;
        }

        .contact-box p {
            color: rgba(255, 255, 255, 0.88);
            margin-bottom: 14px;
        }

        .contact-list {
            display: grid;
            gap: 14px;
            margin-top: 22px;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .contact-form {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 28px;
            padding: 28px;
            backdrop-filter: blur(8px);
        }

        .contact-form label {
            display: block;
            font-size: 0.88rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            border: none;
            border-radius: 16px;
            padding: 14px 16px;
            font-family: inherit;
            margin-bottom: 16px;
            background: rgba(255, 255, 255, 0.94);
            color: var(--text);
        }

        .contact-form textarea {
            min-height: 120px;
            resize: vertical;
        }

        .contact-form button {
            width: 100%;
            border: none;
            border-radius: 999px;
            padding: 14px 20px;
            background: var(--white);
            color: var(--primary-dark);
            font-weight: 700;
            cursor: pointer;
            transition: transform .3s ease, background .3s ease;
        }

        .contact-form button:hover {
            transform: translateY(-2px);
            background: #f3f4f6;
        }

        /* ================= FOOTER ================= */
        footer {
            background: #122016;
            color: rgba(255, 255, 255, 0.75);
            padding: 30px 0;
            text-align: center;
            font-size: 0.95rem;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 1024px) {

            .about-grid,
            .contact-box {
                grid-template-columns: 1fr;
            }

            .card-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                border-radius: 32px;
                align-items: stretch;
            }

            .nav-links {
                justify-content: flex-start;
            }

            .hero {
                min-height: 560px;
            }

            .hero-content {
                padding: 56px 28px 96px;
            }

            .hero-highlights {
                gap: 14px;
            }

            .search-bar-wrapper {
                margin-top: -36px;
            }

            .search-inner {
                border-radius: 28px;
            }

            .card-grid,
            .services-grid {
                grid-template-columns: 1fr;
            }

            section {
                padding: 72px 0;
            }

            .contact-box {
                padding: 36px 28px;
            }
        }
    </style>
        <div class="container" id="beranda" style="padding-top: 32px;">
            <section class="hero">
                <div class="hero-content">
                    <div class="hero-badge">🌿 Organisasi Perempuan Nahdlatul Ulama</div>

                    <h1>{{ $profil?->nama_pac ?? 'PAC Fatayat NU Pragaan' }}</h1>

                    <p>
                        Membangun perempuan muda yang berdaya, mandiri, dan aktif dalam kegiatan sosial, keagamaan, serta
                        pemberdayaan masyarakat melalui pelayanan publik yang terbuka dan mudah diakses.
                    </p>

                    <div class="hero-actions">
                        <a href="{{ route('pengaduan.publik.create') }}" class="btn-primary">Lapor Pengaduan</a>
                        <a href="{{ route('pengaduan.publik.cek') }}" class="btn-secondary">Cek Status Pengaduan</a>
                    </div>

                    <div class="hero-highlights" aria-label="Keunggulan layanan">
                        <div class="hero-highlight">
                            <strong>Terbuka</strong>
                            <span>Akses layanan publik</span>
                        </div>
                        <div class="hero-highlight">
                            <strong>Responsif</strong>
                            <span>Pantau setiap laporan</span>
                        </div>
                        <div class="hero-highlight">
                            <strong>Berdaya</strong>
                            <span>Bersama untuk masyarakat</span>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="container search-bar-wrapper">
            <div class="search-bar">
                <div class="search-inner">
                    <div class="search-item">
                        <label>Cari Informasi</label>
                        <input type="text" placeholder="Berita, layanan, kegiatan...">
                    </div>

                    <div class="search-item">
                        <label>Kategori</label>
                        <input type="text" placeholder="Pilih kategori">
                    </div>

                    <div class="search-item">
                        <label>Lokasi</label>
                        <input type="text" placeholder="Pragaan, Sumenep">
                    </div>

                    <button class="search-button">🔍 Cari</button>
                </div>
            </div>
        </div>

        <section id="profil">
            <div class="container">
                <div class="section-header">
                    <div>
                        <h2>Tentang PAC Fatayat NU</h2>
                        <p>Profil organisasi, visi, dan misi yang menjadi dasar gerakan pemberdayaan perempuan muda
                            Nahdlatul Ulama di tingkat kecamatan.</p>
                    </div>
                </div>

                <div class="about-grid">
                    <div class="about-image">
                        <img src="https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=900&q=80"
                            alt="Kegiatan organisasi">
                        <div class="about-badge">📍 {{ $profil?->alamat ?? 'Pragaan, Sumenep' }}</div>
                    </div>

                    <div class="about-content">
                        <h3>{{ $profilOrganisasi?->nama_organisasi ?? ($profil?->nama_pac ?? 'PAC Fatayat NU') }}</h3>

                        <p>
                            {{ $profilOrganisasi?->deskripsi ?? 'PAC Fatayat NU berkomitmen menjadi wadah pembinaan, pengembangan, dan pemberdayaan perempuan muda melalui kegiatan sosial, pendidikan, dakwah, dan pelayanan masyarakat yang inklusif dan berkelanjutan.' }}
                        </p>

                        <div class="mission-list">
                            @forelse ($misiOrganisasi->take(3) as $misi)
                                <div class="mission-item">
                                    <div class="mission-icon">✓</div>
                                    <div>
                                        <strong>{{ $misi->judul ?? 'Misi Organisasi' }}</strong>
                                        <p>{{ $misi->isi ?? ($misi->deskripsi ?? 'Mendorong penguatan kapasitas kader dan pelayanan masyarakat yang lebih baik.') }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="mission-item">
                                    <div class="mission-icon">✓</div>
                                    <div>
                                        <strong>Pemberdayaan perempuan muda</strong>
                                        <p>Mengembangkan kapasitas kader melalui pendidikan, pelatihan, dan pengabdian
                                            sosial.</p>
                                    </div>
                                </div>

                                <div class="mission-item">
                                    <div class="mission-icon">✓</div>
                                    <div>
                                        <strong>Pelayanan masyarakat yang inklusif</strong>
                                        <p>Memberikan ruang partisipasi bagi masyarakat dalam menyampaikan aspirasi dan
                                            pengaduan.</p>
                                    </div>
                                </div>

                                <div class="mission-item">
                                    <div class="mission-icon">✓</div>
                                    <div>
                                        <strong>Penguatan organisasi dan kaderisasi</strong>
                                        <p>Membangun organisasi yang profesional, transparan, dan berkelanjutan di tingkat
                                            PAC, PR, dan PAR.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <a href="#kontak" class="btn-primary">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="berita">
            <div class="container">
                <div class="section-header">
                    <div>
                        <h2>Berita & Publikasi</h2>
                        <p>Informasi terbaru mengenai kegiatan organisasi, program kerja, dan publikasi yang dapat diakses
                            masyarakat tanpa perlu login.</p>
                    </div>

                    <a href="{{ route('berita.publik.index') }}" class="card-link">Lihat Semua Berita</a>
                </div>

                <div class="card-grid">
                    @forelse ($beritaTerbaru as $berita)
                        <article class="card">
                            <div class="card-image">
                                <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=900&q=80' }}"
                                    alt="{{ $berita->judul }}">
                            </div>

                            <div class="card-body">
                                <h3>{{ $berita->judul }}</h3>

                                <p>
                                    {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi ?? ($berita->konten ?? '')), 120) }}
                                </p>

                                <a href="{{ route('berita.publik.show', $berita) }}" class="card-link">Baca
                                    Selengkapnya</a>
                            </div>
                        </article>
                    @empty
                        <article class="card">
                            <div class="card-image">
                                <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=900&q=80"
                                    alt="Berita organisasi">
                            </div>
                            <div class="card-body">
                                <h3>Kegiatan Organisasi Terbaru</h3>
                                <p>Publikasi berita organisasi akan tampil di sini setelah data berita dipublikasikan oleh
                                    administrator PAC Fatayat NU.</p>
                                <a href="{{ route('berita.publik.index') }}" class="card-link">Lihat Publikasi</a>
                            </div>
                        </article>

                        <article class="card">
                            <div class="card-image">
                                <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=900&q=80"
                                    alt="Program kaderisasi">
                            </div>
                            <div class="card-body">
                                <h3>Program Kaderisasi Perempuan Muda</h3>
                                <p>Informasi mengenai pelatihan, kaderisasi, dan kegiatan penguatan kapasitas anggota
                                    Fatayat NU di wilayah PAC.</p>
                                <a href="{{ route('berita.publik.index') }}" class="card-link">Lihat Publikasi</a>
                            </div>
                        </article>

                        <article class="card">
                            <div class="card-image">
                                <img src="https://images.unsplash.com/photo-1515169067868-5387ec356754?auto=format&fit=crop&w=900&q=80"
                                    alt="Pelayanan masyarakat">
                            </div>
                            <div class="card-body">
                                <h3>Pelayanan Masyarakat dan Pengaduan</h3>
                                <p>Masyarakat dapat mengikuti informasi layanan publik, pengaduan, dan kegiatan sosial yang
                                    diselenggarakan oleh PAC Fatayat NU.</p>
                                <a href="{{ route('pengaduan.publik.create') }}" class="card-link">Ajukan Pengaduan</a>
                            </div>
                        </article>
                    @endforelse
                </div>
            </div>
        </section>

        <section id="dokumentasi">
            <div class="container">
                <div class="section-header">
                    <div>
                        <h2>Galeri Dokumentasi</h2>
                        <p>Dokumentasi kegiatan organisasi, pengajian, kaderisasi, bakti sosial, dan berbagai program
                            pemberdayaan masyarakat yang telah dilaksanakan.</p>
                    </div>

                    <a href="{{ route('dokumentasi.publik.index') }}" class="card-link">Lihat Semua Dokumentasi</a>
                </div>

                <div class="card-grid">
                    @forelse ($dokumentasiPublik as $dokumentasi)
                        <article class="card">
                            <div class="card-image">
                                <img src="{{ $dokumentasi->gambar ? asset('storage/' . $dokumentasi->gambar) : 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=900&q=80' }}"
                                    alt="{{ $dokumentasi->judul }}">
                            </div>

                            <div class="card-body">
                                <h3>{{ $dokumentasi->judul }}</h3>

                                <p>
                                    {{ \Illuminate\Support\Str::limit(strip_tags($dokumentasi->deskripsi ?? ''), 120) }}
                                </p>

                                <a href="{{ route('dokumentasi.publik.index') }}" class="card-link">Lihat Dokumentasi</a>
                            </div>
                        </article>
                    @empty
                        <article class="card">
                            <div class="card-image">
                                <img src="https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=900&q=80"
                                    alt="Kegiatan organisasi">
                            </div>
                            <div class="card-body">
                                <h3>Kegiatan Pengajian dan Dakwah</h3>
                                <p>Dokumentasi kegiatan keagamaan dan pembinaan anggota Fatayat NU di tingkat PAC, PR, dan
                                    PAR akan tampil di sini.</p>
                                <a href="{{ route('dokumentasi.publik.index') }}" class="card-link">Lihat Dokumentasi</a>
                            </div>
                        </article>

                        <article class="card">
                            <div class="card-image">
                                <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=900&q=80"
                                    alt="Kaderisasi Fatayat NU">
                            </div>
                            <div class="card-body">
                                <h3>Pelatihan dan Kaderisasi</h3>
                                <p>Foto kegiatan pelatihan kepemimpinan, kaderisasi, dan penguatan kapasitas perempuan muda
                                    Nahdlatul Ulama di wilayah PAC.</p>
                                <a href="{{ route('dokumentasi.publik.index') }}" class="card-link">Lihat Dokumentasi</a>
                            </div>
                        </article>

                        <article class="card">
                            <div class="card-image">
                                <img src="https://images.unsplash.com/photo-1515169067868-5387ec356754?auto=format&fit=crop&w=900&q=80"
                                    alt="Bakti sosial masyarakat">
                            </div>
                            <div class="card-body">
                                <h3>Bakti Sosial dan Pelayanan Masyarakat</h3>
                                <p>Kegiatan sosial, santunan, dan pelayanan masyarakat yang menjadi bagian dari pengabdian
                                    PAC Fatayat NU kepada masyarakat luas.</p>
                                <a href="{{ route('dokumentasi.publik.index') }}" class="card-link">Lihat Dokumentasi</a>
                            </div>
                        </article>
                    @endforelse
                </div>
            </div>
        </section>

        <section id="layanan">
            <div class="container">
                <div class="section-header">
                    <div>
                        <h2>Layanan Publik</h2>
                        <p>Akses layanan publik PAC Fatayat NU yang dirancang agar mudah digunakan oleh masyarakat tanpa
                            perlu melakukan login ke sistem.</p>
                    </div>
                </div>

                <div class="services-grid">
                    <div class="service-card">
                        <div class="service-icon">📝</div>
                        <h3>Ajukan Pengaduan</h3>
                        <p>Sampaikan laporan, aspirasi, atau pengaduan masyarakat secara langsung kepada PAC Fatayat NU
                            sesuai wilayah pelayanan.</p>
                        <a href="{{ route('pengaduan.publik.create') }}" class="card-link">Buka Layanan</a>
                    </div>

                    <div class="service-card">
                        <div class="service-icon">🔎</div>
                        <h3>Cek Status Pengaduan</h3>
                        <p>Pantau perkembangan penanganan pengaduan menggunakan nomor pengaduan yang telah diterima saat
                            pelaporan.</p>
                        <a href="{{ route('pengaduan.publik.cek') }}" class="card-link">Cek Sekarang</a>
                    </div>

                    <div class="service-card">
                        <div class="service-icon">📰</div>
                        <h3>Berita Organisasi</h3>
                        <p>Ikuti informasi terbaru mengenai kegiatan, program kerja, dan publikasi resmi PAC Fatayat NU
                            untuk masyarakat umum.</p>
                        <a href="{{ route('berita.publik.index') }}" class="card-link">Lihat Berita</a>
                    </div>

                    <div class="service-card">
                        <div class="service-icon">📸</div>
                        <h3>Dokumentasi Kegiatan</h3>
                        <p>Akses galeri dokumentasi kegiatan organisasi, kaderisasi, pengajian, dan program sosial yang
                            telah dilaksanakan.</p>
                        <a href="{{ route('dokumentasi.publik.index') }}" class="card-link">Lihat Galeri</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact-section" id="kontak">
            <div class="container">
                <div class="contact-box">
                    <div>
                        <h2>Hubungi PAC Fatayat NU</h2>

                        <p>
                            Kami terbuka untuk menerima pertanyaan, kerja sama, aspirasi, maupun pengaduan masyarakat
                            terkait kegiatan dan pelayanan PAC Fatayat NU.
                        </p>

                        <div class="contact-list">
                            <div class="contact-item">
                                <span>📍</span>
                                <div>
                                    <strong>Alamat Sekretariat</strong><br>
                                    {{ $profil?->alamat ?? 'Sekretariat PAC Fatayat NU Pragaan, Kabupaten Sumenep, Jawa Timur' }}
                                </div>
                            </div>

                            <div class="contact-item">
                                <span>📞</span>
                                <div>
                                    <strong>Telepon / WhatsApp</strong><br>
                                    {{ $profil?->telepon ?? '+62 8xx xxxx xxxx' }}
                                </div>
                            </div>

                            <div class="contact-item">
                                <span>✉️</span>
                                <div>
                                    <strong>Email Organisasi</strong><br>
                                    {{ $profil?->email ?? 'fatayat@example.com' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <form class="contact-form">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" placeholder="Nama Anda">

                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="email@contoh.com">

                        <label for="pesan">Pesan</label>
                        <textarea id="pesan" placeholder="Tulis pertanyaan atau pesan Anda..."></textarea>

                        <button type="submit">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </section>

        <footer>
            <div class="container">
                © {{ date('Y') }} {{ $profil?->nama_pac ?? 'PAC Fatayat NU Pragaan' }} — Sistem Informasi dan Layanan
                Publik Masyarakat
            </div>
        </footer>

@endsection
