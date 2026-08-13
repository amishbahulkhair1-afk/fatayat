<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('no_pengaduan')->unique();
            $table->string('kategori');
            $table->string('jenis_kekerasan')->nullable();
            $table->date('tanggal_pengaduan');
            $table->string('nama_pelapor');
            $table->string('kontak_pelapor')->nullable();
            $table->text('isi_pengaduan');
            $table->string('bukti_pendukung')->nullable();
            $table->enum('status', ['Baru', 'Diproses', 'Selesai', 'Ditolak'])->default('Baru');
            $table->text('tanggapan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
