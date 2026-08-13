<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = [
        'pac_id',
        'pr_id',
        'par_id',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'no_telepon',
        'alamat_lengkap',
        'pekerjaan',
        'email',
        'tanggal_bergabung',
        'status_anggota',
        'no_kta',
        'foto_kader',
        'riwayat_pendidikan',
        'keterampilan_pekerjaan',
    ];

    public function pac()
    {
        return $this->belongsTo(Pac::class);
    }
    public function pr()
    {
        return $this->belongsTo(Pr::class);
    }
    public function par()
    {
        return $this->belongsTo(Par::class);
    }
    public function riwayatKaderisasi()
    {
        return $this->hasMany(RiwayatKaderisasi::class);
    }
}