<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';

    protected $fillable = [
        'kegiatan_id',
        'pengurus_id',
        'status_kehadiran',
        'keterangan',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function pengurus()
    {
        return $this->belongsTo(Pengurus::class);
    }
}