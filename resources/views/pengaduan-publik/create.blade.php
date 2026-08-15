@extends('layouts.userapp')

@section('title', 'Ajukan Pengaduan - Fatayat NU PAC Pragaan')

@section('description', 'Sampaikan pengaduan kepada Fatayat NU PAC Pragaan.')

@include('pengaduan-publik._styles')

@section('content')

    <section class="page-header">

        <div class="container">

            <div class="page-header-content">

                <span class="page-badge">
                    📋 Layanan Publik
                </span>

                <h1>
                    Ajukan Pengaduan
                </h1>

                <p>
                    Sampaikan laporan, aspirasi, atau pengaduan
                    Anda kepada Fatayat NU PAC Pragaan.
                </p>

            </div>

        </div>

    </section>


    <section class="section">

        <div class="container">

            <div class="form-card">

                <div class="form-header">

                    <div class="form-icon">
                        📋
                    </div>

                    <div>

                        <h2>
                            Form Pengaduan Masyarakat
                        </h2>

                        <p>
                            Silakan lengkapi data berikut
                            dengan informasi yang benar.
                        </p>

                    </div>

                </div>


                @if ($errors->any())

                    <div class="alert alert-danger">

                        <span>!</span>

                        <div>

                            <strong>
                                Periksa kembali data Anda.
                            </strong>

                            <ul style="margin-top:5px; padding-left:18px;">

                                @foreach ($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach

                            </ul>

                        </div>

                    </div>

                @endif


                <form action="{{ route('pengaduan.publik.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf


                    {{-- =========================================
                     INFORMASI PENGADUAN
                ========================================== --}}

                    <div class="form-grid">

                        <div class="form-group">

                            <label class="form-label">
                                Kategori Pengaduan
                                <span class="required">*</span>
                            </label>

                            <select name="kategori" class="form-control">

                                <option value="">
                                    -- Pilih Kategori --
                                </option>

                                @foreach ($kategoriList as $k)
                                    <option value="{{ $k }}" {{ old('kategori') == $k ? 'selected' : '' }}>

                                        {{ $k }}

                                    </option>
                                @endforeach

                            </select>

                            @error('kategori')
                                <div class="form-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="form-group">

                            <label class="form-label">
                                Jenis Kekerasan
                                <span style="font-weight:400;color:#8a968f;">
                                    (jika ada)
                                </span>
                            </label>

                            <select name="jenis_kekerasan" class="form-control">

                                <option value="">
                                    -- Tidak Ada --
                                </option>

                                @foreach ($jenisKekerasanList as $j)
                                    <option value="{{ $j }}"
                                        {{ old('jenis_kekerasan') == $j ? 'selected' : '' }}>

                                        {{ $j }}

                                    </option>
                                @endforeach

                            </select>

                        </div>


                        <div class="form-group">

                            <label class="form-label">
                                Tanggal Kejadian
                                <span class="required">*</span>
                            </label>

                            <input type="date" name="tanggal_pengaduan" value="{{ old('tanggal_pengaduan') }}"
                                class="form-control">

                            @error('tanggal_pengaduan')
                                <div class="form-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- =========================================
                     DATA PELAPOR
                ========================================== --}}

                    <div
                        style="
                        margin:
                            15px 0 20px;
                        padding-top:25px;
                        border-top:1px solid var(--border);
                    ">

                        <h3
                            style="
                            color:var(--primary-dark);
                            font-size:18px;
                            margin-bottom:5px;
                        ">

                            Data Pelapor

                        </h3>

                        <p
                            style="
                            color:var(--text-light);
                            font-size:13px;
                            margin-bottom:20px;
                        ">

                            Informasi ini digunakan untuk
                            keperluan verifikasi dan tindak lanjut.

                        </p>

                    </div>


                    <div class="form-grid">

                        <div class="form-group">

                            <label class="form-label">
                                Nama Pelapor
                                <span class="required">*</span>
                            </label>

                            <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor') }}"
                                class="form-control" placeholder="Masukkan nama lengkap">

                            @error('nama_pelapor')
                                <div class="form-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="form-group">

                            <label class="form-label">
                                Kontak
                                <span style="font-weight:400;color:#8a968f;">
                                    (No. HP / Email)
                                </span>
                            </label>

                            <input type="text" name="kontak_pelapor" value="{{ old('kontak_pelapor') }}"
                                class="form-control" placeholder="08xxxxxxxxxx / email">

                        </div>


                        <div class="form-group">

                            <label class="form-label">
                                Email untuk Notifikasi
                                <span style="font-weight:400;color:#8a968f;">
                                    (Opsional)
                                </span>
                            </label>

                            <input type="email" name="email_pelapor" value="{{ old('email_pelapor') }}"
                                class="form-control" placeholder="email@contoh.com">

                            <p style="margin-top:6px;color:var(--text-light);font-size:12px;">
                                Kami mengirim pemberitahuan ke email ini saat Admin PAC memberi tanggapan.
                            </p>

                            @error('email_pelapor')
                                <div class="form-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- =========================================
                     ALAMAT
                ========================================== --}}

                    <div class="address-box">

                        <div class="address-title">

                            <span>📍</span>

                            Data Domisili Pelapor

                        </div>


                        <div class="form-grid">

                            {{-- ALAMAT LENGKAP --}}

                            <div class="form-group form-grid-full">

                                <label class="form-label">
                                    Alamat Lengkap
                                    <span class="required">*</span>
                                </label>

                                <textarea name="alamat_lengkap" rows="3" class="form-control"
                                    placeholder="Contoh: Dusun Krajan RT 01/RW 02, Jalan Raya Pragaan">{{ old('alamat_lengkap') }}</textarea>

                                @error('alamat_lengkap')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- DESA --}}

                            <div class="form-group">

                                <label class="form-label">
                                    Desa / Kelurahan
                                    <span class="required">*</span>
                                </label>

                                <input type="text" name="desa_kelurahan" value="{{ old('desa_kelurahan') }}"
                                    class="form-control" placeholder="Nama desa / kelurahan">

                                @error('desa_kelurahan')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- KECAMATAN --}}

                            <div class="form-group">

                                <label class="form-label">
                                    Kecamatan
                                    <span class="required">*</span>
                                </label>

                                <input type="text" name="kecamatan" value="{{ old('kecamatan', 'Pragaan') }}"
                                    class="form-control" placeholder="Nama kecamatan">

                                @error('kecamatan')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- KABUPATEN --}}

                            <div class="form-group form-grid-full">

                                <label class="form-label">
                                    Kabupaten
                                    <span class="required">*</span>
                                </label>

                                <input type="text" name="kabupaten" value="{{ old('kabupaten', 'Sumenep') }}"
                                    class="form-control" placeholder="Nama kabupaten">

                                @error('kabupaten')
                                    <div class="form-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>


                        <div class="form-help">

                            💡 Pastikan alamat yang Anda masukkan
                            sesuai dengan domisili pelapor.
                            Data wilayah digunakan untuk membantu
                            proses verifikasi pengaduan.

                        </div>

                    </div>


                    {{-- =========================================
                     ISI PENGADUAN
                ========================================== --}}

                    <div class="form-group">

                        <label class="form-label">
                            Isi Pengaduan
                            <span class="required">*</span>
                        </label>

                        <textarea name="isi_pengaduan" rows="6" class="form-control"
                            placeholder="Jelaskan secara rinci mengenai pengaduan yang ingin Anda sampaikan...">{{ old('isi_pengaduan') }}</textarea>

                        @error('isi_pengaduan')
                            <div class="form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- =========================================
                     BUKTI
                ========================================== --}}

                    <div class="form-group">

                        <label class="form-label">
                            Bukti Pendukung
                            <span style="font-weight:400;color:#8a968f;">
                                (Opsional)
                            </span>
                        </label>

                        <div class="upload-box">

                            <div class="upload-icon">
                                📎
                            </div>

                            <strong>
                                Lampirkan bukti pendukung
                            </strong>

                            <span>
                                JPG, PNG, atau PDF
                            </span>

                            <input type="file" name="bukti_pendukung" accept="image/jpeg,image/png,application/pdf">

                        </div>

                        @error('bukti_pendukung')
                            <div class="form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- =========================================
                     ACTION
                ========================================== --}}

                    <div class="form-actions">

                        <a href="{{ url('/') }}" class="btn btn-secondary">

                            ← Kembali

                        </a>


                        <button type="submit" class="btn btn-primary">

                            📤 Kirim Pengaduan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>

@endsection
