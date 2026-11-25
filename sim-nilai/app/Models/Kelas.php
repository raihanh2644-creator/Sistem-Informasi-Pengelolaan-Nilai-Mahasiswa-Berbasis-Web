<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = ['mata_kuliah_id', 'dosen_id', 'semester_id', 'nama_kelas', 'hari', 'jam_mulai', 'jam_selesai', 'ruangan'];

    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class);
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    public function krs(): HasMany
    {
        return $this->hasMany(Krs::class);
    }

    /** Mahasiswa yang mengambil kelas ini lewat KRS (banyak ke banyak). */
    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'krs', 'kelas_id', 'mahasiswa_id')->withTimestamps();
    }

    public function absensi(): HasMany
    {
        return $this->hasMany(Absensi::class);
    }

    public function pengumuman(): HasMany
    {
        return $this->hasMany(Pengumuman::class);
    }
}
