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
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pac_id')->nullable()->constrained('pacs')->nullOnDelete();
            $table->foreignId('pr_id')->nullable()->constrained('prs')->nullOnDelete();
            $table->foreignId('par_id')->nullable()->constrained('pars')->nullOnDelete();

            // Data Pribadi
            $table->string('nama_lengkap');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('no_telepon')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('email')->nullable();

            // Data Keanggotaan
            $table->date('tanggal_bergabung');
            $table->string('status_anggota');
            $table->string('no_kta')->unique()->nullable();
            $table->string('foto_kader')->nullable();

            // Data Pribadi (Opsional)
            $table->text('riwayat_pendidikan')->nullable();
            $table->text('keterampilan_pekerjaan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
