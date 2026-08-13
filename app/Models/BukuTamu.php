<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model
{
    protected $table = 'buku_tamu';

    protected $fillable = [
        'nama_tamu',
        'asal_instansi',
        'tujuan_kunjungan',
        'tanggal_kunjungan',
        'jam_kunjungan',
        'kontak',
        'keterangan',
    ];
}