<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';

    protected $fillable = [
        'no_pengaduan',
        'user_id',
        'kategori',
        'jenis_kekerasan',
        'tanggal_pengaduan',
        'nama_pelapor',
        'alamat_lengkap',
        'desa_kelurahan',
        'kecamatan',
        'kabupaten',
        'kontak_pelapor',
        'email_pelapor',
        'isi_pengaduan',
        'bukti_pendukung',
        'status',
        'tanggapan_admin',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
