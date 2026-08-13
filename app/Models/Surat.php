<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';

    protected $fillable = [
        'jenis',
        'nomor_surat',
        'tanggal',
        'pengirim_tujuan',
        'perihal',
        'jenis_surat',
        'sifat_surat',
        'file_surat',
        'keterangan',
    ];
}