<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PacController;
use App\Http\Controllers\PrController;
use App\Http\Controllers\ParController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\LembagaController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\RiwayatKaderisasiController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ProfilOrganisasiController;
use App\Http\Controllers\ProgramKerjaController;
use App\Http\Controllers\MonitoringLembagaController;
use App\Http\Controllers\MonitoringAnggotaController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengaduanPublikController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\BeritaPublikController;
use App\Http\Controllers\DokumentasiPublikController;
use App\Http\Controllers\NotulenController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MonitoringParController;
use App\Models\Berita;
use App\Models\Profil;
use App\Models\Dokumentasi;
use App\Models\ProfilOrganisasi;
use App\Models\MisiOrganisasi;
use App\Models\DokumentasiKegiatan;

// ===== ROUTE PUBLIK =====
Route::get('/publikasi/berita', [BeritaPublikController::class, 'index'])->name('berita.publik.index');
Route::get('/publikasi/berita/{berita}', [BeritaPublikController::class, 'show'])->name('berita.publik.show');
Route::get('/publikasi/dokumentasi', [DokumentasiPublikController::class, 'index'])->name('dokumentasi.publik.index');
Route::get('/cek-pengaduan', [PengaduanPublikController::class, 'cekStatus'])->name('pengaduan.publik.cek');
Route::post('/cek-pengaduan', [PengaduanPublikController::class, 'cariStatus'])->name('pengaduan.publik.cari');
Route::get('/lapor-pengaduan', [PengaduanPublikController::class, 'create'])->name('pengaduan.publik.create');
Route::post('/lapor-pengaduan', [PengaduanPublikController::class, 'store'])->name('pengaduan.publik.store');
Route::get('/lapor-pengaduan/sukses/{noPengaduan}', [PengaduanPublikController::class, 'sukses'])->name('pengaduan.publik.sukses');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/profil', [ProfilOrganisasiController::class, 'index'])
    ->name('profil.publik');
Route::get('/', function () {
    $profil = ProfilOrganisasi::first();

    $misi = MisiOrganisasi::all();

    $beritaTerbaru = Berita::where('status', 'Publik')
        ->latest()
        ->take(3)
        ->get();

    $dokumentasiTerbaru = DokumentasiKegiatan::latest()
        ->take(6)
        ->get();

    return view('welcome', compact(
        'profil',
        'misi',
        'beritaTerbaru',
        'dokumentasiTerbaru'
    ));
});


Route::middleware('auth')->group(function () {
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===== KHUSUS ADMIN PAC =====
Route::middleware(['auth', 'role:admin_pac'])->group(function () {
    Route::get('/dashboard-pac', [DashboardController::class, 'pac'])->name('dashboard.pac');

    Route::resource('pengurus', PengurusController::class)
        ->parameters(['pengurus' => 'pengurus']);
    Route::resource('pac', PacController::class)
        ->parameters(['pac' => 'pac']);
    Route::resource('pr', PrController::class)
        ->parameters(['pr' => 'pr']);
    Route::resource('lembaga', LembagaController::class)
        ->parameters(['lembaga' => 'lembaga']);
    Route::resource('jabatan', JabatanController::class)
        ->parameters(['jabatan' => 'jabatan']);
    Route::resource('riwayat-kaderisasi', RiwayatKaderisasiController::class)
        ->parameters(['riwayat-kaderisasi' => 'riwayat_kaderisasi']);
    Route::resource('kegiatan', KegiatanController::class)
        ->parameters(['kegiatan' => 'kegiatan']);
    Route::resource('surat', SuratController::class)
        ->parameters(['surat' => 'surat']);
    Route::resource('inventaris', InventarisController::class)
        ->parameters(['inventaris' => 'inventaris']);
    Route::resource('berita', BeritaController::class)
        ->parameters(['berita' => 'berita']);
    Route::resource('dokumentasi', DokumentasiController::class)
        ->parameters(['dokumentasi' => 'dokumentasi']);
    Route::resource('notulen', NotulenController::class)
        ->parameters(['notulen' => 'notulen']);
    Route::resource('buku-tamu', BukuTamuController::class)
        ->parameters(['buku-tamu' => 'bukuTamu']);
    Route::resource('pengaduan', PengaduanController::class)->except(['create', 'store'])
        ->parameters(['pengaduan' => 'pengaduan']);
    Route::resource('lembaga.program-kerja', ProgramKerjaController::class)
        ->parameters(['lembaga' => 'lembaga', 'program-kerja' => 'program_kerja']);
    Route::resource('peminjaman', PeminjamanController::class)
        ->parameters(['peminjaman' => 'peminjaman']);

    Route::get('/kegiatan/{kegiatan}/absensi', [AbsensiController::class, 'input'])->name('absensi.input');
    Route::post('/kegiatan/{kegiatan}/absensi', [AbsensiController::class, 'simpan'])->name('absensi.simpan');
    Route::get('/kegiatan/{kegiatan}/absensi/detail', [AbsensiController::class, 'detail'])->name('absensi.detail');

    Route::prefix('profil-organisasi')->name('profil-organisasi.')->group(function () {
        Route::get('/sejarah', [ProfilOrganisasiController::class, 'sejarah'])->name('sejarah');
        Route::post('/sejarah', [ProfilOrganisasiController::class, 'updateSejarah'])->name('sejarah.update');
        Route::get('/visi-misi', [ProfilOrganisasiController::class, 'visiMisi'])->name('visi-misi');
        Route::post('/visi-misi', [ProfilOrganisasiController::class, 'updateVisiMisi'])->name('visi-misi.update');
        Route::get('/struktur', [ProfilOrganisasiController::class, 'struktur'])->name('struktur');
        Route::post('/struktur', [ProfilOrganisasiController::class, 'updateStruktur'])->name('struktur.update');
    });

    Route::get('/monitoring/lembaga', [MonitoringLembagaController::class, 'index'])->name('monitoring.lembaga');
    Route::get('/monitoring/par', [MonitoringParController::class, 'index'])->name('monitoring.par');
    Route::post('/peminjaman/{peminjaman}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
    Route::post('/pengaduan/{pengaduan}/proses', [PengaduanController::class, 'proses'])->name('pengaduan.proses');
    Route::post('/pengaduan/{pengaduan}/tolak', [PengaduanController::class, 'tolak'])->name('pengaduan.tolak');
    Route::post('/pengaduan/{pengaduan}/selesai', [PengaduanController::class, 'selesai'])->name('pengaduan.selesai');

    Route::get('/laporan/notulen', [LaporanController::class, 'notulen'])->name('laporan.notulen');
    Route::get('/laporan/notulen/pdf', [LaporanController::class, 'notulenPdf'])->name('laporan.notulen.pdf');
    Route::get('/laporan/buku-tamu', [LaporanController::class, 'bukuTamu'])->name('laporan.buku-tamu');
    Route::get('/laporan/buku-tamu/pdf', [LaporanController::class, 'bukuTamuPdf'])->name('laporan.buku-tamu.pdf');
    Route::get('/laporan/inventaris', [LaporanController::class, 'inventaris'])->name('laporan.inventaris');
    Route::get('/laporan/inventaris/pdf', [LaporanController::class, 'inventarisPdf'])->name('laporan.inventaris.pdf');
});

// ===== ADMIN PAC & ADMIN PR =====
Route::middleware(['auth', 'role:admin_pac,admin_pr'])->group(function () {
    Route::resource('par', ParController::class)
        ->parameters(['par' => 'par']);
    Route::get('/monitoring/anggota', [MonitoringAnggotaController::class, 'index'])->name('monitoring.anggota');
});

// ===== ADMIN PAC & ADMIN PAR =====
Route::middleware(['auth', 'role:admin_pac,admin_par'])->group(function () {
    Route::resource('anggota', AnggotaController::class)
        ->parameters(['anggota' => 'anggota']);
});

// ===== ADMIN PAC & ADMIN PR & ADMIN PAR =====
Route::middleware(['auth', 'role:admin_pac,admin_pr,admin_par'])->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/anggota', [LaporanController::class, 'anggota'])->name('laporan.anggota');
    Route::get('/laporan/anggota/pdf', [LaporanController::class, 'anggotaPdf'])->name('laporan.anggota.pdf');
});

// ===== KHUSUS ADMIN PR =====
Route::middleware(['auth', 'role:admin_pr'])->group(function () {
    Route::get('/dashboard-pr', [DashboardController::class, 'pr'])->name('dashboard.pr');
});

// ===== KHUSUS ADMIN PAR =====
Route::middleware(['auth', 'role:admin_par'])->group(function () {
    Route::get('/dashboard-par', [DashboardController::class, 'par'])->name('dashboard.par');
});

require __DIR__ . '/auth.php';
