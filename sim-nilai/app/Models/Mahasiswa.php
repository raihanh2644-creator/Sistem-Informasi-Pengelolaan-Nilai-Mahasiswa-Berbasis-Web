<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = ['user_id', 'nim', 'nama', 'prodi', 'angkatan'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function krs(): HasMany
    {
        return $this->hasMany(Krs::class);
    }

    /** Kelas yang diambil lewat KRS (banyak ke banyak). */
    public function kelas(): BelongsToMany
    {
        return $this->belongsToMany(Kelas::class, 'krs', 'mahasiswa_id', 'kelas_id')->withTimestamps();
    }

    public function absensi(): HasMany
    {
        return $this->hasMany(Absensi::class);
    }
}
