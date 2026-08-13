<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pac extends Model
{
    protected $table = 'pacs';

    protected $fillable = [
        'nama',
        'kecamatan',
        'tanggal_dibentuk',
        'status',
        'ketua_id',
        'sekertaris_id',
        'bendahara_id',
        'jumlah_anggota',
        'kontak',
        'keterangan',
    ];

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
    public function prs()
    {
        return $this->hasMany(Pr::class);
    }
    public function pengurus()
    {
        return $this->hasMany(Pengurus::class);
    }

    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }

    public function getJumlahAnggotaAttribute()
    {
        return $this->anggota()->count();
    }

    public function lembaga()
    {
        return $this->hasMany(Lembaga::class);
    }
}