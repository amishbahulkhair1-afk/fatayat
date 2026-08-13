<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'kategori',
        'penulis',
        'tanggal_kegiatan',
        'lokasi',
        'isi_berita',
        'gambar_utama',
        'status',
    ];
}