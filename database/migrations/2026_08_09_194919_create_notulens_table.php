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
        Schema::create('notulen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')->nullable()->constrained('kegiatan')->nullOnDelete();
            $table->string('judul');
            $table->date('tanggal');
            $table->string('pemimpin_rapat')->nullable();
            $table->string('notulis')->nullable();
            $table->longText('isi_notulen');
            $table->string('file_lampiran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notulens');
    }
};
