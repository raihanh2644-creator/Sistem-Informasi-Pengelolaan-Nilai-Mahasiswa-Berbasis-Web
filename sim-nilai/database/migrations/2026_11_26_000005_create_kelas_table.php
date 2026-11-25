<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->cascadeOnDelete();
            $table->foreignId('dosen_id')->constrained('dosen')->restrictOnDelete();
            $table->foreignId('semester_id')->constrained('semester')->cascadeOnDelete();
            $table->string('nama_kelas');                 // A, B, C, ...
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('ruangan');
            $table->timestamps();

            // Satu mata kuliah tidak boleh punya dua kelas bernama sama di semester yang sama.
            $table->unique(['mata_kuliah_id', 'semester_id', 'nama_kelas']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
