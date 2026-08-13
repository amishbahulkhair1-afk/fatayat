<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';

    protected $fillable = [
        'no_pengaduan',
        'kategori',
        'jenis_kekerasan',
        'tanggal_pengaduan',
        'nama_pelapor',
        'kontak_pelapor',
        'isi_pengaduan',
        'bukti_pendukung',
        'status',
        'tanggapan_admin',
    ];
}