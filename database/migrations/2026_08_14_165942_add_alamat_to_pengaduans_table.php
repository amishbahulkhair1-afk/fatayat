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
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->text('alamat_lengkap')->nullable()->after('nama_pelapor');
            $table->string('desa_kelurahan')->nullable()->after('alamat_lengkap');
            $table->string('kecamatan')->default('Pragaan')->after('desa_kelurahan');
            $table->string('kabupaten')->default('Sumenep')->after('kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            //
        });
    }
};
