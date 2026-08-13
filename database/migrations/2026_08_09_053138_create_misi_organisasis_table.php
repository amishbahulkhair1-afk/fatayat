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
        Schema::create('misi_organisasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profil_organisasi_id')->constrained('profil_organisasi')->onDelete('cascade');
            $table->text('isi_misi');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('misi_organisasis');
    }
};
