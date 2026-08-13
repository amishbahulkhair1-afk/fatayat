<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';

    protected $fillable = [
        'nama_kegiatan',
        'jenis_kegiatan',
        'tanggal_kegiatan',
        'jam_mulai',
        'jam_selesai',
        'lokasi_kegiatan',
        'penanggung_jawab_id',
        'deskripsi_kegiatan',
        'target_peserta',
        'status_kegiatan',
    ];

    public function penanggungJawab()
    {
        return $this->belongsTo(Pengurus::class, 'penanggung_jawab_id');
    }

    public function pesertaTertentu()
    {
        return $this->belongsToMany(Pengurus::class, 'kegiatan_peserta');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function getTotalHadirAttribute()
    {
        return $this->absensi()->where('status_kehadiran', 'Hadir')->count();
    }

    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class);
    }
}