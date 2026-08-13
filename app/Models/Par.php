<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Par extends Model
{
    protected $table = 'pars';

    protected $fillable = [
        'pr_id',
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

    public function pr()
    {
        return $this->belongsTo(Pr::class);
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

    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }

    public function getJumlahAnggotaAttribute()
    {
        return $this->anggota()->count();
    }
}
