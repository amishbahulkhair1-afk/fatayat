<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notulen extends Model
{
    protected $table = 'notulen';

    protected $fillable = [
        'kegiatan_id',
        'judul',
        'tanggal',
        'pemimpin_rapat',
        'notulis',
        'isi_notulen',
        'file_lampiran',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}