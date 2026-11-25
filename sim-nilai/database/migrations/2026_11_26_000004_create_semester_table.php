<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('semester', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran');               // contoh: 2026/2027
            $table->enum('periode', ['ganjil', 'genap']);
            $table->boolean('is_aktif')->default(false);  // hanya satu semester aktif (dijaga di kode)
            $table->timestamps();

            $table->unique(['tahun_ajaran', 'periode']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('semester');
    }
};
