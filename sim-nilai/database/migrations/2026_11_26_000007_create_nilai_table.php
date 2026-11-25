<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('krs_id')->unique()->constrained('krs')->cascadeOnDelete();
            $table->decimal('tugas', 5, 2)->nullable();
            $table->decimal('uts', 5, 2)->nullable();
            $table->decimal('uas', 5, 2)->nullable();
            $table->decimal('nilai_akhir', 5, 2)->nullable(); // dihitung otomatis oleh model
            $table->string('grade', 2)->nullable();           // dihitung otomatis oleh model
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
