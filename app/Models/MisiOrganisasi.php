<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MisiOrganisasi extends Model
{
    protected $table = 'misi_organisasi';

    protected $fillable = ['profil_organisasi_id', 'isi_misi', 'urutan'];

    public function profil()
    {
        return $this->belongsTo(ProfilOrganisasi::class, 'profil_organisasi_id');
    }
}