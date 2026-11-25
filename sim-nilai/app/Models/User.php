<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['username', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    public function mahasiswa(): HasOne
    {
        return $this->hasOne(Mahasiswa::class);
    }

    public function dosen(): HasOne
    {
        return $this->hasOne(Dosen::class);
    }

    public function pengumuman(): HasMany
    {
        return $this->hasMany(Pengumuman::class);
    }

    /**
     * Peran dikenali dari tabel profil (tidak ada kolom role di users).
     * ASUMSI: akun tanpa profil mahasiswa/dosen dianggap admin.
     * Ubah method ini kalau cara mengenali admin diputuskan lain
     * (misalnya username tertentu seperti 'admin').
     */
    public function getPeranAttribute(): string
    {
        if ($this->mahasiswa()->exists()) {
            return 'mahasiswa';
        }
        if ($this->dosen()->exists()) {
            return 'dosen';
        }
        return 'admin';
    }

    public function isAdmin(): bool
    {
        return $this->peran === 'admin';
    }

    public function isDosen(): bool
    {
        return $this->peran === 'dosen';
    }

    public function isMahasiswa(): bool
    {
        return $this->peran === 'mahasiswa';
    }
}
