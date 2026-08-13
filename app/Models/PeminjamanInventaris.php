<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanInventaris extends Model
{
    protected $table = 'peminjaman_inventaris';

    protected $fillable = [
        'inventaris_id',
        'pengurus_id',
        'jumlah_pinjam',
        'tanggal_pinjam',
        'tanggal_kembali_rencana',
        'tanggal_kembali_aktual',
        'status',
        'keterangan',
    ];

    public function inventaris()
    {
        return $this->belongsTo(Inventaris::class);
    }

    public function pengurus()
    {
        return $this->belongsTo(Pengurus::class);
    }
}