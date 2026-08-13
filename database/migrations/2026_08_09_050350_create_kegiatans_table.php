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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->string('jenis_kegiatan');
            $table->date('tanggal_kegiatan');
            $table->time('jam_mulai');
            $table->time('jam_selesai')->nullable();
            $table->string('lokasi_kegiatan')->nullable();
            $table->foreignId('penanggung_jawab_id')->nullable()->constrained('pengurus')->nullOnDelete();
            $table->text('deskripsi_kegiatan')->nullable();
            $table->enum('target_peserta', ['semua', 'tertentu'])->default('semua');
            $table->string('status_kegiatan')->default('Terjadwal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
