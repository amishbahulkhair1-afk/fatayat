<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $table = 'inventaris';

    protected $fillable = [
        'kode_inventaris',
        'nama_barang',
        'kategori',
        'merk_tipe',
        'tahun_perolehan',
        'kondisi',
        'lokasi_penyimpanan',
        'jumlah',
        'satuan',
        'deskripsi',
    ];

    public function peminjaman()
    {
        return $this->hasMany(PeminjamanInventaris::class);
    }
}