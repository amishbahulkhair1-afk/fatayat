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
        Schema::create('pengurus', function (Blueprint $table) {
            $table->id();

            // Detail Pengurus
            $table->string('nama_lengkap'); // sertakan gelar
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->date('tanggal_lahir');
            $table->text('alamat_domisili');
            $table->enum('status_menikah', ['Menikah', 'Belum Menikah']);
            $table->string('pekerjaan')->nullable();

            // Pendidikan
            $table->string('sd_sederajat')->nullable();
            $table->year('sd_tahun_lulus')->nullable();
            $table->string('smp_sederajat')->nullable();
            $table->year('smp_tahun_lulus')->nullable();
            $table->string('sma_sederajat')->nullable();
            $table->year('sma_tahun_lulus')->nullable();
            $table->string('pondok_pesantren')->nullable();
            $table->string('s1')->nullable();
            $table->string('s2')->nullable();
            $table->string('s3')->nullable();

            // Organisasi & Pengkaderan
            $table->string('pengkaderan_fatayat')->nullable();
            $table->string('pengkaderan_nu')->nullable();
            $table->text('pengalaman_organisasi')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('asal_pr')->nullable();
            $table->string('asal_par')->nullable();
            $table->string('pelatihan')->nullable();

            // Lain-lain
            $table->text('potensi')->nullable();
            $table->text('produk_usaha')->nullable();
            $table->text('prestasi')->nullable();

            // Dokumen (simpan path file)
            $table->string('foto_ktp')->nullable();
            $table->string('foto_seragam')->nullable();
            $table->string('sertifikat_pengkaderan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penguruses');
    }
};
