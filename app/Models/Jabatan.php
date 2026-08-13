<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';

    protected $fillable = [
        'pengurus_id',
        'pac_id',
        'pr_id',
        'par_id',
        'lembaga_id',
        'nama_jabatan',
        'periode_mulai',
        'periode_selesai',
        'status',
    ];

    public function pengurus()
    {
        return $this->belongsTo(Pengurus::class);
    }

    public function pac()
    {
        return $this->belongsTo(Pac::class);
    }

    public function pr()
    {
        return $this->belongsTo(Pr::class);
    }

    public function par()
    {
        return $this->belongsTo(Par::class);
    }

    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class);
    }
}
