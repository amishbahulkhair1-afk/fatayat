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
        Schema::create('riwayat_kaderisasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengurus_id')->nullable()->constrained('pengurus')->nullOnDelete();
            $table->foreignId('anggota_id')->nullable()->constrained('anggota')->nullOnDelete();
            $table->string('jabatan')->nullable();
            $table->foreignId('pr_id')->nullable()->constrained('prs')->nullOnDelete();
            $table->foreignId('par_id')->nullable()->constrained('pars')->nullOnDelete();
            $table->string('penyelenggara')->nullable();
            $table->string('jenjang_kaderisasi');
            $table->string('lokasi')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->string('no_sertifikat')->nullable();
            $table->year('tahun')->nullable();
            $table->string('upload_sertifikat')->nullable();
            $table->string('status'); // "Anggota" atau "Pengurus", terisi otomatis
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_kaderisasis');
    }
};
