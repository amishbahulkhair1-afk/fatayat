<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $table = 'pengurus';

    protected $fillable = [
        'pac_id',
        // Detail Pengurus
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat_domisili',
        'status_menikah',
        'pekerjaan',
        // Pendidikan
        'sd_sederajat',
        'sd_tahun_lulus',
        'smp_sederajat',
        'smp_tahun_lulus',
        'sma_sederajat',
        'sma_tahun_lulus',
        'pondok_pesantren',
        's1',
        's2',
        's3',
        // Organisasi & Pengkaderan
        'pengkaderan_fatayat',
        'pengkaderan_nu',
        'pengalaman_organisasi',
        'jabatan',
        'asal_pr',
        'asal_par',
        'pelatihan',
        // Lain-lain
        'potensi',
        'produk_usaha',
        'prestasi',
        // Dokumen
        'foto_ktp',
        'foto_seragam',
        'sertifikat_pengkaderan',
    ];

    public function pac()
    {
        return $this->belongsTo(Pac::class);
    }
}
