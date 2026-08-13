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
        Schema::create('dokumentasi_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('judul_dokumentasi');
            $table->string('kategori');
            $table->date('tanggal_kegiatan');
            $table->text('deskripsi_singkat')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['Publikasi', 'Draft'])->default('Draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumentasi_kegiatans');
    }
};
