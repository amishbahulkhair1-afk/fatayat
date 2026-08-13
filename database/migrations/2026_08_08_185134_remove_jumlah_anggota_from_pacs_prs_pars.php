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
        Schema::table('pacs', function (Blueprint $table) {
            $table->dropColumn('jumlah_anggota');
        });
        Schema::table('prs', function (Blueprint $table) {
            $table->dropColumn('jumlah_anggota');
        });
        Schema::table('pars', function (Blueprint $table) {
            $table->dropColumn('jumlah_anggota');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pacs_prs_pars', function (Blueprint $table) {
            //
        });
    }
};
