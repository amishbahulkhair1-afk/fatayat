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
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['Masuk', 'Keluar']);
            $table->string('nomor_surat');
            $table->date('tanggal');
            $table->string('pengirim_tujuan'); // Pengirim (kalau Masuk) / Tujuan (kalau Keluar)
            $table->string('perihal');
            $table->string('jenis_surat');
            $table->string('sifat_surat');
            $table->string('file_surat')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
