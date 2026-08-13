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
        Schema::create('prs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pac_id')->constrained('pacs')->onDelete('cascade');
            $table->string('nama');
            $table->string('kode_pr')->unique();
            $table->string('desa');
            $table->string('kecamatan');
            $table->date('tanggal_dibentuk');
            $table->string('status');
            $table->foreignId('ketua_id')->nullable()->constrained('pengurus')->nullOnDelete();
            $table->foreignId('sekertaris_id')->nullable()->constrained('pengurus')->nullOnDelete();
            $table->foreignId('bendahara_id')->nullable()->constrained('pengurus')->nullOnDelete();
            $table->integer('jumlah_anggota')->default(0);
            $table->string('no_telepon')->nullable();
            $table->string('alamat_sekertaris')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prs');
    }
};
