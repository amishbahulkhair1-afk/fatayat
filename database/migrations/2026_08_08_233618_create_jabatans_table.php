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
        Schema::create('jabatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengurus_id')->constrained('pengurus')->onDelete('cascade');
            $table->foreignId('pac_id')->nullable()->constrained('pacs')->nullOnDelete();
            $table->foreignId('pr_id')->nullable()->constrained('prs')->nullOnDelete();
            $table->foreignId('par_id')->nullable()->constrained('pars')->nullOnDelete();
            $table->foreignId('lembaga_id')->nullable()->constrained('lembaga')->nullOnDelete();
            $table->string('nama_jabatan');
            $table->year('periode_mulai');
            $table->year('periode_selesai');
            $table->string('status')->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatans');
    }
};
