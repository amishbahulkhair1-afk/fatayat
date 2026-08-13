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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori');
            $table->string('penulis');
            $table->date('tanggal_kegiatan');
            $table->string('lokasi')->nullable();
            $table->longText('isi_berita');
            $table->string('gambar_utama')->nullable();
            $table->enum('status', ['Publik', 'Draft', 'Dijadwalkan'])->default('Draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
