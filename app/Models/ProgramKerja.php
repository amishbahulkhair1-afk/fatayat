<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramKerja extends Model
{
    protected $table = 'program_kerja';

    protected $fillable = ['lembaga_id', 'nama_program_kerja', 'deskripsi', 'status'];

    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class);
    }
}