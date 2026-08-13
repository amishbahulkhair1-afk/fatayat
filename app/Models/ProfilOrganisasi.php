<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilOrganisasi extends Model
{
    protected $table = 'profil_organisasi';

    protected $fillable = [
        'judul_utama',
        'sub_judul',
        'gambar_sampul',
        'konten_sejarah',
        'visi',
        'foto_struktur',
    ];

    public function misi()
    {
        return $this->hasMany(MisiOrganisasi::class)->orderBy('urutan');
    }
}