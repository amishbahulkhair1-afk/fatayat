<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKaderisasi extends Model
{
    protected $table = 'riwayat_kaderisasi';

    protected $fillable = [
        'pengurus_id',
        'anggota_id',
        'jabatan',
        'pr_id',
        'par_id',
        'penyelenggara',
        'jenjang_kaderisasi',
        'lokasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'no_sertifikat',
        'tahun',
        'upload_sertifikat',
        'status',
    ];

    public function pengurus()
    {
        return $this->belongsTo(Pengurus::class);
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function pr()
    {
        return $this->belongsTo(Pr::class);
    }

    public function par()
    {
        return $this->belongsTo(Par::class);
    }

    public function getNamaKaderAttribute()
    {
        return $this->pengurus->nama_lengkap ?? $this->anggota->nama_lengkap ?? '-';
    }
}