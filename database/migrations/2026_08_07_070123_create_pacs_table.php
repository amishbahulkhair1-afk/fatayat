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
        Schema::create('pacs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kecamatan');
            $table->date('tanggal_dibentuk');
            $table->string('status');
            $table->foreignId('ketua_id')->nullable()->constrained('pengurus')->nullOnDelete();
            $table->foreignId('sekertaris_id')->nullable()->constrained('pengurus')->nullOnDelete();
            $table->foreignId('bendahara_id')->nullable()->constrained('pengurus')->nullOnDelete();
            $table->integer('jumlah_anggota')->default(0);
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
        Schema::dropIfExists('pacs');
    }
};
