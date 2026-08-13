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
        Schema::create('buku_tamu', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tamu');
            $table->string('asal_instansi')->nullable();
            $table->string('tujuan_kunjungan');
            $table->date('tanggal_kunjungan');
            $table->time('jam_kunjungan')->nullable();
            $table->string('kontak')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_tamus');
    }
};
