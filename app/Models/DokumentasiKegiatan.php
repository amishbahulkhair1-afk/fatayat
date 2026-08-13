<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumentasiKegiatan extends Model
{
    protected $table = 'dokumentasi_kegiatan';

    protected $fillable = [
        'judul_dokumentasi',
        'kategori',
        'tanggal_kegiatan',
        'deskripsi_singkat',
        'foto',
        'status',
    ];
}