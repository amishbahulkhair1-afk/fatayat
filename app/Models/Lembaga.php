<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    protected $table = 'lembaga';

    protected $fillable = [
        'pac_id',
        'nama_lembaga',
        'singkatan',
        'ketua_id',
        'tanggal_dibentuk',
        'status',
        'deskripsi',
        'kontak',
    ];

    public function pac()
    {
        return $this->belongsTo(Pac::class);
    }

    public function ketua()
    {
        return $this->belongsTo(Pengurus::class, 'ketua_id');
    }

    public function programKerja()
    {
        return $this->hasMany(ProgramKerja::class);
    }

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }
}
