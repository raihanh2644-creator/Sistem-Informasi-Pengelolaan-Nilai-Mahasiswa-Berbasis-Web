<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('krs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->cascadeOnDelete();
            $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
            $table->timestamps();

            // Mahasiswa tidak boleh mengambil kelas yang sama dua kali.
            $table->unique(['mahasiswa_id', 'kelas_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};
