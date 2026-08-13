<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pr extends Model
{
    protected $table = 'prs';

    protected $fillable = [
        'pac_id',
        'nama',
        'kode_pr',
        'desa',
        'kecamatan',
        'tanggal_dibentuk',
        'status',
        'ketua_id',
        'sekertaris_id',
        'bendahara_id',
        'jumlah_anggota',
        'no_telepon',
        'alamat_sekertaris',
        'keterangan',
    ];

    public function pac()
    {
        return $this->belongsTo(Pac::class);
    }
    public function ketua()
    {
        return $this->belongsTo(Pengurus::class, 'ketua_id');
    }
    public function sekertaris()
    {
        return $this->belongsTo(Pengurus::class, 'sekertaris_id');
    }
    public function bendahara()
    {
        return $this->belongsTo(Pengurus::class, 'bendahara_id');
    }
    public function pars()
    {
        return $this->hasMany(Par::class);
    }

    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }

    public function getJumlahAnggotaAttribute()
    {
        return $this->anggota()->count();
    }
}
